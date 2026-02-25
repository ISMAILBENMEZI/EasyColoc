<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $activeMembership  = Membership::with('colocation')
                        ->where('user_id',Auth::id())
                        ->whereNull('left_at')
                        ->first();
        return view('dashboard',[
            'activeMembership' => $activeMembership,
            'activeColocation' => $activeMembership?->colocation,
        ]);
    }
}
