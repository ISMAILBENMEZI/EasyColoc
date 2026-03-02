<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Colocation\LeaveColocationRequest;
use App\Models\ExpenseDebt;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function leave()
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')
                ->with('status', 'No active colocation found');
        }

        if ($membership->role === 'owner') {
            return back()->with('status', 'Owner cannot leave. Cancel colocation or transfer ownership.');
        }


        if ($membership->colocation->status !== 'active') {
            return redirect()->route('dashboard')->with('status', 'This colocation is inactive.');
        }
        $colocationId = $membership->colocation_id;

        $hasPendingDebts = ExpenseDebt::where('from_user_id', $userId)
            ->where('status', 'pending')
            ->whereHas('expense', fn($q) => $q->where('colocation_id', $colocationId))
            ->exists();

        DB::transaction(function () use ($membership, $userId, $hasPendingDebts) {
            $membership->left_at = now();
            $membership->save();

            $delta = $hasPendingDebts ? -1 : +1;

            User::where('id', $userId)->update([
                'reputation' => DB::raw("reputation + ($delta)")
            ]);
        });

        return redirect()->route('dashboard')->with(
            'status',
            $hasPendingDebts ? 'You left with pending debts. Reputation -1.' : 'You left with no debts. Reputation +1.'
        );
    }

    public function kick(User $user)
    {
        $ownerId = Auth::id();

        $ownerMembership = Membership::where('user_id', $ownerId)
            ->whereNull('left_at')
            ->first();

        if (! $ownerMembership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation found.');
        }

        if ($ownerMembership->role !== 'owner') {
            return back()->with('status', 'Only owner can kick members.');
        }

        $colocationId = $ownerMembership->colocation_id;

        $targetMembership = Membership::where('user_id', $user->id)
            ->where('colocation_id', $colocationId)
            ->whereNull('left_at')
            ->first();

        if ($targetMembership->colocation->status !== 'active') {
            return redirect()->route('dashboard')->with('status', 'This colocation is inactive.');
        }

        if (!$targetMembership) {
            return back()->with('status', 'Member not found in your colocation.');
        }

        if ($targetMembership->role === 'owner') {
            return back()->with('status', 'You cannot kick the owner.');
        }

        Db::transaction(function () use ($colocationId, $ownerId, $targetMembership, $user) {
            ExpenseDebt::where('from_user_id', $user->id)
                ->where('status', 'pending')
                ->whereHas('expense', fn($q) => $q->where('colocation_id', $colocationId))
                ->update([
                    'from_user_id' => $ownerId
                ]);

            $targetMembership->left_at = now();
            $targetMembership->save();
        });

        return back()->with('status', 'Member kicked. Their pending debts were transferred to the owner.');
    }
}
