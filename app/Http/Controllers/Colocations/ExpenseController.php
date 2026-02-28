<?php

namespace App\Http\Controllers\Colocations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Colocation\StoreExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Models\ExpenseDebt;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation found');
        }

        $colocationId = $membership->colocation_id;

        $month = request('month');

        $query = Expense::with(['payer', 'category'])
            ->where('colocation_id', $colocationId)
            ->orderByDesc('date')
            ->orderByDesc('id');

        if ($month) {
            $year = substr($month, 0, 4);
            $m = substr($month, 5, 2);

            if ($year > 0 && $m >= 1 && $m <= 12) {
                $query->whereYear('date', $year)->whereMonth('date', $m);
            }
        }

        $expenses = $query->paginate(10)->withQuerystring();

        return view('expenses.index', [
            'expenses' => $expenses,
            'month' => $month,
        ]);
    }

    public function create()
    {
        $userId = Auth::id();

        $membership = Membership::with('colocation')
            ->where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation found');
        }

        $colocation = $membership->colocation;

        $categories = Category::where('colocation_id', $colocation->id)
            ->orderBy('name')
            ->get();

        $members = Membership::with('user')
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->orderByRaw("CASE WHEN role='owner' THEN 0 ELSE 1 END")
            ->orderBy('id')
            ->get();

        return view('expenses.create', [
            'membership' => $membership,
            'colocation' => $colocation,
            'categories' => $categories,
            'members' => $members,
        ]);
    }

    public function store(StoreExpenseRequest $request)
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('status', 'No active colocation found');
        }

        $data = $request->validated();

        $expense = DB::transaction(function () use ($data, $membership, $userId) {
            $expense = Expense::create([
                'colocation_id' => $membership->colocation_id,
                'category_id' => $data['category_id'] ?? null,
                'payer_id' => $data['payer_id'],
                'created_by' => $userId,
                'title' => $data['title'],
                'amount' => $data['amount'],
                'date' => $data['date'],
            ]);

            $members = Membership::where('colocation_id', $membership->colocation_id)
                ->whereNull('left_at')
                ->get();

            $count = $members->count();

            $share = $expense->amount / $count;

            foreach ($members as $m) {
                if ($m->user_id != $expense->payer_id) {
                    ExpenseDebt::create([
                        'expense_id' => $expense->id,
                        'from_user_id' => $m->user_id,
                        'to_user_id' => $expense->payer_id,
                        'amount' => $share,
                        'status' => 'pending',
                        'paid_at' => null,
                    ]);
                }
            }

            return $expense;
        });

        return redirect()->route('expenses.show', $expense->id)
            ->with('status', 'Expense added successfully');
    }

    public function show(Expense $expense)
    {
        $userId = Auth::id();

        $myMembership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        if (!$myMembership) {
            return redirect()->route('dashboard')
                ->with('status', 'No active colocation found');
        }

        if ($expense->colocation_id != $myMembership->colocation_id) {
            return redirect()->route('dashboard')
                ->with('status', 'You are not allowed to view this expense');
        }

        $expense->load(['payer', 'category', 'creator']);

        $members = Membership::with('user')
            ->where('colocation_id', $expense->colocation_id)
            ->whereNull('left_at')
            ->get();

        $membersCount = $members->count();

        $share = $expense->amount / $membersCount;

        $debts = [];
        foreach ($members as $m) {
            if ($m->user_id != $expense->payer_id) {
                $debts[] = [
                    'from_user' => $m->user,
                    'to_user' => $expense->payer,
                    'amount' => $share,
                ];
            }
        }

        return view('expenses.show', [
            'expense' => $expense,
            'membersCount' => $membersCount,
            'share' => $share,
            'debts' => $debts,
        ]);
    }
}
