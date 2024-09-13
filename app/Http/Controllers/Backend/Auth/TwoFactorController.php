<?php

namespace App\Http\Controllers\Backend\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    public function __construct() {

    }

    public function show2faForm(Request $request)
    {
        
        $user = Auth::user();
        $google2fa = new Google2FA();

        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $qrCodeUrl  = $google2fa->getQRCodeUrl(
            'Laravel 11 RealeState', 
            $user->email, 
            $user->google2fa_secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(500, 500),
            new SvgImageBackEnd(),
        );
        $writer = new Writer($renderer);
        $qrCode = $writer->writeString($qrCodeUrl);
        
        return view('backend.admin.auth.2FA.two-factor', compact('qrCode'));
    }

    public function enable2fa(Request $request)
    {
        $user = Auth::user();
        $user->google2fa_enable = true;
        $user->save();

        return redirect()->route('2fa.verify')->with('success', 'Kích hoạt mã 2FA thành công!.');
    }

    public function showVerifyForm() {
        return view('backend.admin.auth.2FA.verify-2fa');
    }
    
    public function verify2fa(Request $request)
    {
    $user = Auth::user();
    $google2fa = new Google2FA();

    $valid = $google2fa->verifyKey($user->google2fa_secret, trim($request->input('2fa_code')));

    if ($valid) {
        $request->session()->put('2fa_passed', true);
        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
    }

    return back()->withErrors(['2fa_code' => 'Mã 2FA không hợp lệ.']);
    }
}