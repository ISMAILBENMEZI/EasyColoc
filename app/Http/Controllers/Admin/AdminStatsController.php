<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\ExpenseDebt;
use App\Models\Invitation;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStatsController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $bannedUsers = User::where('is_banned', true)->count();

        $totalColocations = Colocation::count();
        $activeColocations = Colocation::where('status', 'active')->count();
        $inactiveColocations = Colocation::where('status', 'cancelled')->count();

        $totalExpenses = Expense::count();
        $sumExpenses = Expense::sum('amount');

        $totalDebtsPending = ExpenseDebt::where('status', 'pending')->count();
        $sumDebtsPending = ExpenseDebt::where('status', 'pending')->sum('amount');

        $totalPayments = Payment::count();
        $sumPayments = Payment::sum('amount');

        $totalInvitations = Invitation::count();
        $pendingInvitations = Invitation::where('status', 'pending')->count();

        return view('admin.stats', compact(
            'totalUsers',
            'bannedUsers',
            'totalColocations',
            'activeColocations',
            'inactiveColocations',
            'totalExpenses',
            'sumExpenses',
            'totalDebtsPending',
            'sumDebtsPending',
            'totalPayments',
            'sumPayments',
            'totalInvitations',
            'pendingInvitations'
        ));
    }
}
