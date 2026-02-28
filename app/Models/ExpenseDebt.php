<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseDebt extends Model
{
    protected $fillable = [
        'expense_id',
        'from_user_id',
        'to_user_id',
        'amount',
        'status',
        'paid_at',
    ];


    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
