<?php

namespace App\Http\Controllers\Colocations;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Membership;
use App\Http\Requests\Colocation\StoreColocationRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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

        return redirect('/dashboard')->with('status' , 'Colocation created successfully!');
    }
}
