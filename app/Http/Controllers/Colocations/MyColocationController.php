<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Expense;
use App\Models\ExpenseDebt;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class MyColocationController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

        $membership = Membership::with('colocation')
            ->where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('status', 'No colocation found');
        }

        $colocation = $membership->colocation;

        $membersCount = Membership::where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->count();

        $totalExpenses = Expense::where('colocation_id', $colocation->id)->sum('amount');

        $latestExpenses = Expense::with(['payer', 'category'])
            ->where('colocation_id', $colocation->id)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        $activeMembers = Membership::with('user')
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->orderByRaw("CASE WHEN role='owner' THEN 0 ELSE 1 END")
            ->OrderBy('id')
            ->get();

        $balances = [];

        foreach ($activeMembers as $m) {
            $balances[$m->user_id] = 0.0;
        }

        // $expenses = Expense::where('colocation_id', $colocation->id)->get();
        $debts = ExpenseDebt::where('status', 'pending')
            ->whereHas('expense', fn($q) => $q->where('colocation_id', $colocation->id))
            ->get();

        foreach ($debts as $d) {
            if (isset($balances[$d->from_user_id])) {
                $balances[$d->from_user_id] -= $d->amount;
            }

            if (isset($balances[$d->to_user_id])) {
                $balances[$d->to_user_id] += $d->amount;
            }
        }

        $payments = Payment::where('colocation_id', $colocation->id)->get();

        foreach ($payments as $p) {
            if (isset($balances[$p->from_user_id])) {
                $balances[$p->from_user_id] += $p->amount;
            }

            if (isset($balances[$p->to_user_id])) {
                $balances[$p->to_user_id] -= $p->amount;
            }
        }

        $memberBalances = [];

        foreach ($activeMembers as $m) {
            $memberBalances[] = [
                'user' => $m->user,
                'role' => $m->role,
                'balance' => round($balances[$m->user_id] ?? 0, 2),
            ];
        }

        $totalDebts = ExpenseDebt::where('from_user_id', $userId)
            ->where('status', 'pending')
            ->whereHas('expense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
            ->sum('amount');

        return view('colocations.my-colocations', [
            'membership' => $membership,
            'colocation' => $colocation,
            'membersCount' => $membersCount,
            'totalExpenses' => $totalExpenses,
            'latestExpenses' => $latestExpenses,
            'activeMembers' => $activeMembers,
            'memberBalances' => $memberBalances,
            'myTotalDebt' => $totalDebts,
        ]);
    }
}
