<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use App\Models\ExpenseDebt;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation found.');
        }

        $debts = ExpenseDebt::with(['expense', 'toUser'])
            ->whereHas('expense', function ($q) use ($membership) {
                $q->where('colocation_id', $membership->colocation_id);
            })
            ->where('from_user_id', $userId)
            ->where('status', 'pending')
            ->orderByDesc('id')
            ->get();

        return view('debts.index', [
            'debts' => $debts,
        ]);
    }
}
