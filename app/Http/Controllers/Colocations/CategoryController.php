<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Colocation\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        Category::create([
            'name' => $request->validated('name'),
            'colocation_id' => $membership->colocation_id,
        ]);

        return redirect()->route('my_colocation.show')
            ->with('status', 'Category added successfully!');
    }
}
