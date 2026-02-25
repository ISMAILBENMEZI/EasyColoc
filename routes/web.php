<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Colocations\ColocationController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/colocations/create' , [ColocationController::class, 'create'])->name('colocations.create');
    Route::post('colocations',[ColocationController::class, 'store'])->name('colocations.store');
    Route::get('/dashboard' , DashboardController::class)->name('dashboard');
});

Route::view('/how-it-works','/how-it-works')->name('how.works');

require __DIR__.'/auth.php';
