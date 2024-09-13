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
use App\Models\User;

class AdminController extends Controller
{
    //
    public function __construct() {

    }

    public function index() {
        return view('backend.admin.dashboard.home.index');
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
        }else {
            return redirect()->route('login.show')->with('error','Email hoặc Mật khẩu không chính xác');
        }
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
        $user->save();
        return redirect()->route('register')->with('success', 'Đăng Ký tài khoản thành công');
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
        $user->password = Hash::make($request->input('$password'));
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
       if ($user->save()) {
        return redirect()->route('admin.profiles')->with('success', 'Profiles Update SuccessFully...');
       } else {
        return redirect()->back()->with('error', 'Profiles Update Failed Please Try Again...');
       }
    }

    public function admin_users_list() {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['name' => 'Danh sách người dùng', 'url' => route('admin.users.index')],      
        ];
        $data['getRecord'] = User::getRecord();
        return view('backend.admin.users.list', compact('breadcrumbs', 'data'));
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
}