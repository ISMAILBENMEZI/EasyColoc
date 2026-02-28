<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use App\Models\ExpenseDebt;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payDebt(ExpenseDebt $debt)
    {
        $userId = Auth::id();

        if ($debt->from_user_id != $userId) {
            return back()->with('status', 'You are not allowed to pay this debt.');
        }

        if ($debt->status === 'paid') {
            return back()->with('status', 'This debt is already paid.');
        }

        DB::transaction(function () use ($debt, $userId) {
            $debt->status = 'paid';
            $debt->paid_at = now();
            $debt->save();

            Payment::create([
                'colocation_id' => $debt->expense->colocation_id,
                'from_user_id' => $userId,
                'to_user_id' => $debt->to_user_id,
                'amount' => $debt->amount,
                'paid_at' => now(),
            ]);

        });

        return redirect()->route('debts.index')->with('status', 'Payment marked as paid!');
    }
}
