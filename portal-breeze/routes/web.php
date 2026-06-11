<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/admin', 'panels.admin')
        ->middleware('role:admin')->name('admin.panel');
    Route::view('/docente', 'panels.docente')
        ->middleware('role:admin,docente')->name('docente.panel');
    Route::view('/estudiante', 'panels.estudiante')
        ->middleware('role:admin,docente,estudiante')->name('estudiante.panel');
});

require __DIR__.'/auth.php';