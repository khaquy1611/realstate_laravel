<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Mail\RegisterMail;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Mail;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
        // examples with aliases, pipe-separated names, guards, etc:
            new Middleware('permission:details users', only: ['admin_users_details']),
        ];
    }
    public function index() {
        $user = User::selectRaw('count(id) as count, DATE_FORMAT(created_at, "%Y-%m") as month')
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();
        $data['months'] = $user->pluck('month');
        $data['counts'] = $user->pluck('count');
        return view('backend.admin.dashboard.home.index', compact('data'));
    }

    public function login_form() {
        return view('backend.admin.auth.login.index');
    }

    public function login(AuthRequest $request) {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($credentials, true)) {   
            $request->session()->regenerate();
            return redirect()->route('2FA.form')->with('success','Đăng nhập thành công');
        }
        return redirect()->route('login.show')->with('error','Email hoặc Mật khẩu không chính xác');
    }
    
    public function register_form() {
        return view('backend.admin.auth.register.index');
    }

    // Register function
    public function register(RegisterRequest $request) {

        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->passwordConfirm = Hash::make($request->passwordConfirm);
        if($user->save()) {
            return redirect()->route('register')->with('success', 'Đăng Ký tài khoản thành công');
        }
        
        return redirect()->route('register')->with('error', 'Đăng Ký tài khoản thất bại , Vui lòng thử lại.');
    }

    public function profiles() {
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('backend.admin.profiles.index', compact('data'));
    }
    
    public function profiles_update(Request $request) {
       $user = request()->validate([
        'email' => 'required|unique:users,email, ' . Auth::user()->id
       ]);
       $user = User::find(Auth::user()->id);
       $user->name = trim($request->input('name'));   
       $user->username = trim($request->input('username'));   
       $user->email = trim($request->input('email'));   
       $user->phone = trim($request->input('phone'));  
       if(!empty($request->input('password'))) {
        $user->password = Hash::make($request->input('password'));
       } 
       if (!empty($request->file('photo'))) {
        $file = $request->file('photo');
        $randomStr = Str::random(30);
        $fileName = $randomStr . '.' . $file->getClientOriginalExtension();
        $file->move('upload/', $fileName);
        $user->photo = $fileName;
       }
       $user->address = trim($request->input('address'));   
       $user->about = trim($request->input('about'));   
       $user->website = trim($request->input('website')); 
       $save = $user->save();
       if ($save) {  
        return redirect()->route('admin.profiles')->with('success', 'Profiles Update SuccessFully...');
        
       } else {
        return redirect()->back()->with('error', 'Profiles Update Failed Please Try Again...');
       }
        
    }

    public function admin_users_list(Request $request) {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách người dùng', 'url' => route('admin.users.index')],      
        ];
        $all_users_with_all_their_roles = User::with('roles')->get();
        $data['getRecord'] = User::getRecord($request);
        $data['totalAdmin'] = User::role('admin')->count();
        $data['totalSuperAdmin'] = User::role(['admin', 'super-admin'])->count();
        $data['totalAgent'] = User::role('agent')->count();
        $data['totalUser'] = User::role('user')->count();
        $data['totalActive'] = User::where('status' , '=' , '1')->count();
        $data['totalInActive'] = User::where('status' , '=' , '0')->count();
        $data['total'] = User::where('status' , '=' , '1')->count();
        return view('backend.admin.users.list', compact('breadcrumbs', 'data', 'all_users_with_all_their_roles'));
    }

    public function admin_users_edit($id = '') {
        $roles = Role::pluck('name', 'name')->all();
        $user = User::findOrFail($id);
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách người dùng', 'url' => route('admin.users.index')],      
            ['name' => 'Sửa người dùng', 'url' => route('admin.users.edit',  $user->id)],      
        ];
        return view('backend.admin.users.edit',compact('user', 'roles', 'breadcrumbs', 'userRoles'));
    }
    
    public function admin_users_update(UpdateUserRequest $request , $id = '') {
        $user = User::findOrFail($id);
        $user->name = trim($request->input('name'));
        $user->username = trim($request->input('username'));
        $user->email = trim($request->input('email'));
        if(!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        } 
        $user->address = trim($request->input('address'));   
        $user->phone = trim($request->input('phone'));
        $user->status = trim($request->input('status'));
        $user->syncRoles($request->roles);
        $result = $user->update();
        if ($result) {
            return redirect()->route('admin.users.index')->with('success', 'Cập nhập người dùng thành công.');
        }
        return redirect()->route('admin.users.index')->with('error', 'Cập nhập người dùng thất bại.');
      
    }
    
    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function refreshCaptcha() {
        return response()->json(['captcha' => Captcha::img('math') ], 200);
    }

    public function toggleStatus(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            // Thay đổi trạng thái kích hoạt
            $user->status = !$user->status;
            $user->save();

            // Trả về kết quả thành công và trạng thái mới
            return response()->json([
                'success' => true,
                'status' => $user->status
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function admin_users_details($id = '') {
        $data['getRecord'] = User::find($id);
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách người dùng', 'url' => route('admin.users.index')],     
            ['name' => 'Xem chi tiết thông tin người dùng', 'url' => route('admin.user.details', $data['getRecord']->id)],     
        ];
       
        return view('backend.admin.users.details', compact('breadcrumbs', 'data'));
    }


    public function admin_users_create() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Tạo mới người dùng', 'url' => route('admin.users.create')],      
        ];
        $roles = Role::pluck('name', 'name')->all();
        return view('backend.admin.users.create', compact('breadcrumbs', 'roles'));
    }


    public function admin_users_store(StoreUserRequest $request) {
        $user = new User;
        $user->name = trim($request->input('name'));
        $user->username = trim($request->input('username'));
        $user->email = trim($request->input('email'));
        if(!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        } 
        $user->address = trim($request->input('address'));   
        $user->phone = trim($request->input('phone'));
        $user->status = trim($request->input('status'));
        $user->remember_token = Str::random(50);
        $user->syncRoles($request->roles);
        $result = $user->save();
        Mail::to($user->email)->send(new RegisterMail($user));
      
        if ($result) {
            return redirect()->route('admin.users.create')->with('success', 'Thêm mới người dùng thành công.');
        }
        return redirect()->route('admin.users.create')->with('error', 'Thêm mới người dùng thất bại.');
    }

    public function set_new_password($token = '') {
        $data['token'] = $token;
        return view('backend.admin.auth.reset.reset_pass', $data);  
    }

    public function set_new_password_post($token = '', ResetPasswordRequest $request) {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
            abort(403);
        }
        $user = $user->first();
        $user->password = Hash::make($request->input('password'));
        $user->passwordConfirm = Hash::make($request->input('passwordConfirm'));
        $user->remember_token = Str::random(50);
        $user->status = '1';
        if ($user->save()) {
            return redirect()->route('login.show')->with('success', 'Mật khẩu mới đã được thiết lập.');
        }
        return redirect()->back()->with('success', 'Thiết lập mật khẩu mới thất bại. Vui lòng thử lại');
    }

    public function permission($id = '') {
       $user = User::find($id);
       $all_column = $user->roles->first();
       $roles = Role::orderBy('id', 'DESC')->get();
       return view('backend.admin.users.permission', compact('user', 'roles'));
    }

    public function admin_users_delete($id = '') {
        $roles = Role::pluck('name', 'name')->all();
        $user = User::findOrFail($id);
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách người dùng', 'url' => route('admin.users.index')],      
            ['name' => 'Xóa người dùng', 'url' => route('admin.users.delete',  $user->id)],      
        ];
        return view('backend.admin.users.delete',compact('user', 'roles', 'breadcrumbs', 'userRoles'));
    }

    public function admin_users_destroy(Request $request , $id = '') {
        $user = User::findOrFail($id);
        $destroy = $user->delete();
        if($destroy) {
            return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công.');
        }
        return redirect()->route('admin.users.index')->with('error', 'Xóa người dùng thất bại. Vui lòng thử lại');
    }

    public function impersonate($id = '') {
        $user = User::find($id);
        if (!auth()->user()->hasAnyRole(['admin', 'super-admin'])) {
            return redirect()->back()->with('error', 'Bạn không có quyền impersonate.'); 
        }
        if ($user) {
            session(['impersonate_original' => auth()->id()]);
            session(['impersonate' => $user->id]);
            return redirect()->route('admin.users.index')->with('success', 'Bạn đã impersonate người dùng ' . $user->name);
        }
        return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
    }
    
    public function stopImpersonate()
    {
    // Kiểm tra xem có đang impersonate hay không
    if (session()->has('impersonate')) {
        // Lấy lại ID của người dùng ban đầu
        $originalUserId = session('impersonate_original');

        // Đăng nhập lại người dùng ban đầu
        Auth::loginUsingId($originalUserId);

        // Xóa session impersonate
        session()->forget(['impersonate', 'impersonate_original']);

        // Chuyển hướng về trang chủ
        return redirect()->route('admin.dashboard')->with('message', 'Bạn đã dừng impersonate.');
    }

    return redirect()->back()->with('error', 'Không có người dùng nào đang bị impersonate.');
    }   

    public function update_name_ajax(Request $request) {
        $recoder = User::find(trim($request->input('edit_id')));
        $recoder->name = trim($request->input('edit_name'));
        $recoder->save();
        $json['success'] = 'Sửa đổi dữ liệu thành công.';
        echo json_encode( $json);
    }
}