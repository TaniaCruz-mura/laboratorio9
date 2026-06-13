<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;
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
Route::middleware(['auth', 'permission:gestionar-roles'])->group(function () {
    Route::get('/usuarios', [UserRoleController::class, 'index'])->name('usuarios.index');
    Route::put('/usuarios/{user}/roles', [UserRoleController::class, 'update'])->name('usuarios.roles.update');
});


require __DIR__.'/auth.php';
