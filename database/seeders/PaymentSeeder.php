<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\Payment;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $colocation = Colocation::where('name', 'Casa Flat')->first();
        $owner = User::where('email', 'ismailbenmezi300@gmail.com')->first();
        $member = User::where('email', 'ismailbenmezi400@gmail.com')->first();

        Payment::firstOrCreate(
            [
                'colocation_id' => $colocation->id,
                'from_user_id' => $member->id,
                'to_user_id' => $owner->id,
                'amount' => 100.00,
            ],
            [
                'paid_at' => now(),
            ]
        );
    }
}
