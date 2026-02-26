<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Expense;
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

        $latestExpenses = Expense::with(['payer' , 'category'])
                        ->where('colocation_id' , $colocation->id)
                        ->orderByDesc('date')
                        ->orderByDesc('id')
                        ->limit(8)
                        ->get();

        return view('colocations.my-colocations',[
            'membership' => $membership,
            'colocation' => $colocation,
            'membersCount' => $membersCount,
            'totalExpenses' => $totalExpenses,
            'latestExpenses' => $latestExpenses,
        ]);
    }
}
