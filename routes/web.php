<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Auth\AdminController;
use App\Http\Controllers\Backend\Auth\AgentController;
use App\Http\Controllers\Backend\Auth\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'preventBackHistory'])->group(function() {
    /* 2FA */
    Route::get('2fa', [TwoFactorController::class, 'show2faForm'])->name('2FA.form');
    Route::post('2fa/enable', [TwoFactorController::class, 'enable2fa'])->name('enable.2fa');
    Route::get('2fa/verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
    Route::post('2fa/verify', [TwoFactorController::class, 'verify2fa'])->name('2fa.verify.post');
});

Route::middleware(['auth', 'role:admin', 'preventBackHistory', '2fa'])->group(function() {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profiles', [AdminController::class, 'profiles'])->name('admin.profiles');
    Route::post('admin/profiles/update', [AdminController::class, 'profiles_update'])->name('admin.profiles.update');

    /* Users */
    Route::get('admin/user', [AdminController::class, 'admin_users_list'])->name('admin.users.index');
    Route::post('admin/users/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle-status');
});

Route::middleware(['auth', 'role:agent', 'preventBackHistory'])->group(function() { 
    Route::get('agent/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
});

/* Admin auth */
Route::get('register', [AdminController::class, 'register_form'])->name('register.show');
Route::post('register', [AdminController::class, 'register'])->name('register');
Route::get('login', [AdminController::class, 'login_form'])->name('login.show');
Route::post('login', [AdminController::class, 'login'])->name('login')->middleware(['preventBackHistory']);
Route::get('refreshCaptcha', [AdminController::class, 'refreshCaptcha'])->name('refresh_captcha');