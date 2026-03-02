<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderByDesc('id')->paginate(12);
        return view('admin.users', ['users' => $users]);
    }

    public function ban(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('status', 'You cannot ban yourself.');
        }

        $user->is_banned = true;
        $user->save();

        return back()->with('status', 'User banned.');
    }

    public function unban(User $user)
    {
        $user->is_banned = false;
        $user->save();

        return back()->with('status', 'User unbanned.');
    }
}
