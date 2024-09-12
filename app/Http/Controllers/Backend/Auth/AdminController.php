<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;

class AdminController extends Controller
{
    //
    public function __construct() {

    }

    public function index() {
        return view('backend.admin.dashboard.home.index');
    }

    public function login(Request $request) {
        return view('backend.admin.auth.login.index');
    }

    public function register(Request $request) {
        return view('backend.admin.auth.register.index');
    }

    public function profiles() {
        return view('backend.admin.profiles.index');
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