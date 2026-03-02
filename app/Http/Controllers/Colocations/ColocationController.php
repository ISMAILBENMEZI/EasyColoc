<?php

namespace App\Http\Controllers\Colocations;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Membership;
use App\Http\Requests\Colocation\StoreColocationRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    public function create()
    {
        return view('colocations.create');
    }

    public function store(StoreColocationRequest $request)
    {
        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
        ]);

        Membership::create([
            'user_id' => Auth::id(),
            'colocation_id' => $colocation->id,
            'role' => 'owner',
            'joined_at' => now(),
            'left_at' => null,
        ]);

        return redirect('/dashboard')->with('status', 'Colocation created successfully!');
    }

    public function deactivate()
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation found.');
        }

        if ($membership->role !== 'owner') {
            return back()->with('status', 'Only the owner can deactivate the colocation.');
        }

        $colocation = $membership->colocation;

        if ($colocation->status !== 'active') {
            return back()->with('status', 'Colocation is already inactive.');
        }

        DB::transaction(function () use ($colocation) {
            $colocation->status = 'cancelled';
            $colocation->save();

            Membership::where('colocation_id', $colocation->id)
                ->whereNull('left_at')
                ->update([
                    'left_at' => now(),
                    'left_reason' => 'archived',
                ]);
        });

        return redirect()->route('dashboard')->with('status', 'Colocation deactivated successfully.');
    }
}
