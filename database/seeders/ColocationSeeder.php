<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colocation;

class ColocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Colocation::firstOrCreate(
            ['name' => 'Casa Flat'],
            ['status' => 'active']
        );
    }
}
