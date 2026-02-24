<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\User;

class MembershipSeeder extends Seeder
{
    public function run(): void
    {
        $colocation = Colocation::where('name', 'Casa Flat')->first();

        $owner = User::where('email', 'ismailbenmezi300@gmail.com')->first();
        $member = User::where('email', 'ismailbenmezi400@gmail.com')->first();

        Membership::firstOrCreate(
            ['user_id' => $owner->id, 'colocation_id' => $colocation->id],
            ['role' => 'owner', 'joined_at' => now(), 'left_at' => null]
        );

        Membership::firstOrCreate(
            ['user_id' => $member->id, 'colocation_id' => $colocation->id],
            ['role' => 'member', 'joined_at' => now(), 'left_at' => null]
        );
    }
}
