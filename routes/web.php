<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Auth\AdminController;
use App\Http\Controllers\Backend\Auth\AgentController;
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

Route::middleware(['auth', 'role:admin', 'preventBackHistory', 'redirectIfAuth'])->group(function() {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'role:agent', 'preventBackHistory', 'redirectIfAuth'])->group(function() {
Route::get('agent/dashboard', [AgentController::class, 'index'])->name('agent.index');
});