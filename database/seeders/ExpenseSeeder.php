<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\User;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $colocation = Colocation::where('name', 'Casa Flat')->first();
        $owner = User::where('email', 'ismailbenmezi300@gmail.com')->first();
        $member = User::where('email', 'ismailbenmezi400@gmail.com')->first();

        $rent = Category::where('name', 'Rent')->where('colocation_id', $colocation->id)->first();
        $groceries = Category::where('name', 'Groceries')->where('colocation_id', $colocation->id)->first();

        Expense::firstOrCreate(
            ['colocation_id' => $colocation->id, 'title' => 'February Rent'],
            [
                'category_id' => $rent->id,
                'created_by' => $owner->id,
                'payer_id' => $owner->id,
                'amount' => 900.00,
                'date' => now()->toDateString(),
            ]
        );

        Expense::firstOrCreate(
            ['colocation_id' => $colocation->id, 'title' => 'Supermarket'],
            [
                'category_id' => $groceries->id,
                'created_by' => $member->id,
                'payer_id' => $owner->id, 
                'amount' => 150.50,
                'date' => now()->toDateString(),
            ]
        );
    }
}
