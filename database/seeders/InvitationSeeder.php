<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Str;

class InvitationSeeder extends Seeder
{
    public function run(): void
    {
        $colocation = Colocation::where('name', 'Casa Flat')->first();
        $owner = User::where('email', 'ismailbenmezi300@gmail.com')->first();

        Invitation::firstOrCreate(
            ['token' => 'demo-token-123'],
            [
                'colocation_id' => $colocation->id,
                'created_by' => $owner->id,
                'email' => 'newuser@gmail.com',
                'status' => 'pending',
                'expires_at' => now()->addDays(2),
            ]
        );
    }
}
