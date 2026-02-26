<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Colocations\ColocationController;
use App\Http\Controllers\Colocations\MyColocationController;
use App\Http\Controllers\Colocations\MembershipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Colocations\InvitationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.create');
    Route::post('colocations', [ColocationController::class, 'store'])->name('colocations.store');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/my-colocation', [MyColocationController::class, 'show'])->name('my_colocation.show');
    Route::post('/colocations/leave', [MembershipController::class, 'leave'])->name('colocations.leave');

    Route::get('/invitations/create', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');

    Route::get('/join', [InvitationController::class, 'joinForm'])->name('invitations.join.form');
    Route::post('/join', [InvitationController::class, 'joinSubmit'])->name('invitations.join.submit');

    Route::get('/invitations/accept/{token}', [InvitationController::class, 'acceptFromLink'])->name('invitations.accept.link');
});

Route::view('/how-it-works', '/how-it-works')->name('how.works');

require __DIR__ . '/auth.php';
