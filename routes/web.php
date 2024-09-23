<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Auth\AdminController;
use App\Http\Controllers\Backend\Auth\AgentController;
use App\Http\Controllers\Backend\Auth\TwoFactorController;
use App\Http\Controllers\Backend\Email\EmailController;
use App\Http\Controllers\Backend\Roles\RoleController;
use App\Http\Controllers\Backend\Roles\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;

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

Route::middleware(['auth', 'preventBackHistory', '2fa', 'role:super-admin|admin', 'isAdmin', 'impersonate'])->group(function() {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/profiles', [AdminController::class, 'profiles'])->name('admin.profiles');
    Route::post('admin/profiles/update', [AdminController::class, 'profiles_update'])->name('admin.profiles.update');

    /* Admin Users */
    Route::get('admin/users', [AdminController::class, 'admin_users_list'])->name('admin.users.index');
    Route::get('admin/users/create', [AdminController::class, 'admin_users_create'])->name('admin.users.create');
    Route::post('admin/users/store', [AdminController::class, 'admin_users_store'])->name('admin.users.store');
    Route::get('admin/users/{id}/edit', [AdminController::class, 'admin_users_edit'])->name('admin.users.edit');
    Route::post('admin/users/{id}/edit', [AdminController::class, 'admin_users_update'])->name('admin.users.update');
    Route::post('admin/users/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::get('admin/users/{id}', [AdminController::class, 'admin_users_details'])->name('admin.user.details');
    Route::get('admin/users/permission/{id}', [AdminController::class, 'permission'])->name('admin.users.permission');
    Route::get('admin/users/{id}/delete', [AdminController::class, 'admin_users_delete'])->name('admin.users.delete');
    Route::post('admin/users/{id}/destroy', [AdminController::class, 'admin_users_destroy'])->name('admin.users.destroy');
    Route::post('admin/users/update/name', [AdminController::class, 'update_name_ajax'])->name('admin.users.update.name');
    
    /* Impersonate (Chuyển quyền nhanh ) */
    Route::get('admin/impersonate/{id}/users', [AdminController::class, 'impersonate'])->name('admin.users.impersonate');
    Route::get('admin/stop-impersonate', [AdminController::class, 'stopImpersonate'])->name('admin.stop.impersonate');
    
    /* Email */
    Route::get('admin/email/compose', [EmailController::class, 'email_compose'])->name('admin.email.compose');
    Route::post('admin/email/compose', [EmailController::class, 'email_compose_post'])->name('admin.email.compose');
    Route::get('admin/email/send', [EmailController::class, 'email_compose_send'])->name('admin.email.send');
    Route::get('admin/email/delete', [EmailController::class, 'email_compose_send_delete'])->name('admin.email.delete');
    Route::get('admin/email/delete', [EmailController::class, 'email_compose_send_delete'])->name('admin.email.delete');
    Route::get('admin/email/read/{id}', [EmailController::class, 'email_compose_read'])->name('admin.email.read');
    Route::get('admin/email/read/delete/{id}', [EmailController::class, 'email_compose_read_delete'])->name('admin.email.read.delete');

    /* Roles */
    Route::get('admin/role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('admin/role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('admin/role/create', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('admin/role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('admin/role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::get('admin/role/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    Route::post('admin/role/destroy/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');


    /* Roles assign perrmission */
    Route::get('admin/roles/{roleId}/permissions', [RoleController::class, 'assignPermission'])->name('admin.role.permissions');
    Route::post('admin/roles/{roleId}/permissions', [RoleController::class, 'updatePermission'])->name('admin.role.permissions');


    /* Permission */
    Route::get('admin/permission', [PermissionController::class , 'index'])->name('admin.permission.index');
    Route::get('admin/permission/create', [PermissionController::class, 'create'])->name('admin.permission.create');
    Route::post('admin/permission/store', [PermissionController::class, 'store'])->name('admin.permission.store');
    Route::get('admin/permission/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
    Route::post('admin/permission/update/{id}', [PermissionController::class, 'update'])->name('admin.permission.update');
    Route::get('admin/permission/delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');
    Route::post('admin/permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('admin.permission.destroy');

    

});

Route::middleware(['auth', 'preventBackHistory', '2fa' , 'role:agent', 'isAgent'])->group(function() { 
    Route::get('agent/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
});

/* Admin auth */

Route::get('register', [AdminController::class, 'register_form'])->name('register.show');
Route::post('register', [AdminController::class, 'register'])->name('register');
Route::get('login', [AdminController::class, 'login_form'])->name('login.show');
Route::post('login', [AdminController::class, 'login'])->name('login')->middleware(['preventBackHistory']);
Route::get('refreshCaptcha', [AdminController::class, 'refreshCaptcha'])->name('refresh_captcha');
Route::get('set_new_password/{token}', [AdminController::class, 'set_new_password'])->name('set_new_password');
Route::post('set_new_password/{token}', [AdminController::class, 'set_new_password_post'])->name('set_new_password');