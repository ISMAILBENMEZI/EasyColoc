<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Colocation\StoreInvitationRequest;
use App\Http\Requests\Colocation\JoinWithTokenRequest;
use App\Models\Invitation;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ColocationInvitationMail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InvitationController extends Controller
{
    public function create()
    {
        return view('invitations.create');
    }

    public function store(StoreInvitationRequest $request)
    {
        $userId = $request->user()->id;

        $ownerMembership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        $invitation = DB::transaction(function () use ($request, $ownerMembership, $userId) {
            $inv = Invitation::create([
                'colocation_id' => $ownerMembership->colocation_id,
                'created_by' => $userId,
                'email' => $request->validated('email'),
                'token' => Str::random(40),
                'status' => 'pending',
                'expires_at' => now()->addDays(3),
            ]);

            return $inv;
        });

        Mail::to($invitation->email)->send(new ColocationInvitationMail($invitation));
        return redirect()->route('my_colocation.show')
            ->with('status', 'Invitation sent successfully!');
    }

    public function joinForm()
    {
        return view('invitations.join');
    }

    public function joinSubmit(JoinWithTokenRequest $request)
    {
        return $this->acceptToken($request->validated('token'), $request->user()->id);
    }

    public function acceptFromLink($token)
    {
        return $this->acceptToken($token, Auth::id());
    }

    public function acceptToken($token, $userId)
    {
        $hasActive = Membership::where('user_id', $userId)->whereNull('left_at')->exists();

        if ($hasActive) {
            return redirect()->route('dashboard')
                ->with('status', 'You already have an active colocation.');
        }

        $invitation = Invitation::where('token', $token)->first();

        if (! $invitation) {
            return back()->withErrors(['token' => 'Invalide token']);
        }

        if ($invitation->status !== 'pending') {
            return redirect()->route('dashboard')
                ->with('status', 'This invitation is not available anymore.');
        }

        if ($invitation->expires_at && now()->greaterThan($invitation->expires_at)) {
            $invitation->status = 'expired';
            $invitation->save();

            return back()->withErrors(['token' => 'This invitation has expired']);
        }

        DB::transaction(function () use ($invitation, $userId) {
            Membership::create([
                'user_id' => $userId,
                'colocation_id' => $invitation->colocation_id,
                'role' => 'member',
                'joined_at' => now(),
                'left_at' => null,
            ]);

            $invitation->status = 'accepted';
            $invitation->save();
        });

        return redirect()->route('my_colocation.show')
            ->with('status', 'Welcome! You joined the colocation successfully.');
    }
}
