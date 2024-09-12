<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function __construct() {

    }

    public function index() {
        return view('backend.admin.dashboard.home.index');
    }

    public function login() {
        return view('backend.admin.auth.login.index');
    }

    public function register() {
        return view('backend.admin.auth.register.index');
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

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function refreshCaptcha() {
        return response()->json(['captcha' => Captcha::img('math') ], 200);
    }
}