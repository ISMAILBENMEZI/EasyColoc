<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Colocation\LeaveColocationRequest;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    public function leave(LeaveColocationRequest $request)
    {
        $user = $request->user();

        $membership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')
                ->with('status', 'No active colocation found');
        }

        DB::transaction(function () use ($membership) {
            $membership->left_at = now();
            $membership->save();
        });
    }
}
