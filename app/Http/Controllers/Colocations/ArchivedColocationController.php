<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\ExpenseDebt;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivedColocationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $archivedMemberships = Membership::with('colocation')
            ->where('user_id', $userId)
            ->whereNotNull('left_at')
            ->where('left_reason', 'archived')
            ->orderByDesc('left_at')
            ->get();

        return view('colocations.archived.index', [
            'archivedMemberships' => $archivedMemberships,
        ]);
    }

    public function show(Colocation $colocation)
    {
        $userId = Auth::id();

        $ok = Membership::where('user_id', $userId)
            ->where('colocation_id', $colocation->id)
            ->where('left_reason', 'archived')
            ->exists();

        if (! $ok) {
            return redirect()->route('dashboard')->with('status', 'Not allowed.');
        }

        $members = Membership::with('user')
            ->where('colocation_id', $colocation->id)
            ->orderByRaw("CASE WHEN role='owner' THEN 0 ELSE 1 END")
            ->orderBy('id')
            ->get();

        $membersCount = $members->count();
        $totalExpenses = Expense::where('colocation_id', $colocation->id)->sum('amount');
        $expensesCount = Expense::where('colocation_id', $colocation->id)->count();

        $latestExpenses = Expense::with(['payer', 'category'])
            ->where('colocation_id', $colocation->id)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $categoriesCount = Category::where('colocation_id', $colocation->id)->count();
        $topCategories = Category::withCount(['expenses as expenses_count'])
            ->where('colocation_id', $colocation->id)
            ->orderByDesc('expenses_count')
            ->limit(5)
            ->get();

        $pendingDebtsTotal = ExpenseDebt::where('status', 'pending')
            ->whereHas('expense', fn($q) => $q->where('colocation_id', $colocation->id))
            ->sum('amount');

        $paidDebtsTotal = ExpenseDebt::where('status', 'paid')
            ->whereHas('expense', fn($q) => $q->where('colocation_id', $colocation->id))
            ->sum('amount');

        $pendingDebtsCount = ExpenseDebt::where('status', 'pending')
            ->whereHas('expense', fn($q) => $q->where('colocation_id', $colocation->id))
            ->count();

        $paymentsTotal = Payment::where('colocation_id', $colocation->id)->sum('amount');
        $paymentsCount = Payment::where('colocation_id', $colocation->id)->count();

        $latestPayments = Payment::with(['fromUser', 'toUser'])
            ->where('colocation_id', $colocation->id)
            ->orderByDesc('paid_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('colocations.archived.show', [
            'colocation' => $colocation,

            'members' => $members,
            'membersCount' => $membersCount,

            'totalExpenses' => $totalExpenses,
            'expensesCount' => $expensesCount,
            'latestExpenses' => $latestExpenses,

            'categoriesCount' => $categoriesCount,
            'topCategories' => $topCategories,

            'pendingDebtsTotal' => $pendingDebtsTotal,
            'paidDebtsTotal' => $paidDebtsTotal,
            'pendingDebtsCount' => $pendingDebtsCount,

            'paymentsTotal' => $paymentsTotal,
            'paymentsCount' => $paymentsCount,
            'latestPayments' => $latestPayments,
        ]);
    }
}
