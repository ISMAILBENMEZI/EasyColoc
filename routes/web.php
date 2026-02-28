<?php

use App\Http\Controllers\Admin\AdminStatsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Colocations\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Colocations\ColocationController;
use App\Http\Controllers\Colocations\DebtController;
use App\Http\Controllers\Colocations\ExpenseController;
use App\Http\Controllers\Colocations\MyColocationController;
use App\Http\Controllers\Colocations\MembershipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Colocations\InvitationController;
use App\Http\Controllers\Colocations\MemberController;
use App\Http\Controllers\Colocations\PaymentController;
use App\Http\Controllers\Colocations\ArchivedColocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:user'])->group(function () {
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
    Route::get('/members/{user}', [MemberController::class, 'show'])->name('members.show');

    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show'])->name('expenses.show');
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

    Route::get('/debts', [DebtController::class, 'index'])->name('debts.index');
    Route::post('/debts/{debt}/pay', [PaymentController::class, 'payDebt'])->name('debts.pay');

    Route::post('/colocation/leave', [MembershipController::class, 'leave'])->name('colocation.leave');
    Route::post('/members/{user}/kick', [MembershipController::class, 'kick'])->name('members.kick');
    Route::post('/colocation/deactivate', [ColocationController::class, 'deactivate'])->name('colocation.deactivate');

    Route::get('/colocations/archived', [ArchivedColocationController::class, 'index'])->name('colocations.archived.index');
    Route::get('/colocations/archived/{colocation}', [ArchivedColocationController::class, 'show'])->name('colocations.archived.show');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/stats', [AdminStatsController::class, 'index'])->name('admin.stats');

    Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users');
    Route::post('/users/{user}/ban', [AdminUsersController::class, 'ban'])->name('admin.users.ban');
    Route::post('/users/{user}/unban', [AdminUsersController::class, 'unban'])->name('admin.users.unban');
});

Route::view('/how-it-works', '/how-it-works')->name('how.works');

require __DIR__ . '/auth.php';
