<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MemberController extends Controller
{
    public function show(User $user)
    {
        $currentUserId = Auth::id();

        $myMembership = Membership::where('user_id', $currentUserId)
            ->whereNull('left_at')
            ->first();

        if (!$myMembership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation');
        }

        $targetMembership = Membership::where('user_id', $user->id)
            ->where('colocation_id', $myMembership->colocation_id)
            ->whereNull('left_at')
            ->first();

        if (!$targetMembership) {
            return redirect()->route('my_colocation.show')->with('status', 'Member not found in your colocation.');
        }

        $ownerMembership = Membership::where('colocation_id', $myMembership->colocation_id)
            ->whereNull('left_at')
            ->where('role', 'owner')
            ->first();

        $ownerId = $ownerMembership?->user_id;

        return view('members.show', [
            'user' => $user,
            'targetMembership' => $targetMembership,
            'ownerId' => $ownerId,
        ]);
    }
}
