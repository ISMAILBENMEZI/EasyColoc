<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Colocation;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $colocation = Colocation::where('name', 'Casa Flat')->first();

        Category::firstOrCreate(['colocation_id' => $colocation->id, 'name' => 'Rent']);
        Category::firstOrCreate(['colocation_id' => $colocation->id, 'name' => 'Groceries']);
        Category::firstOrCreate(['colocation_id' => $colocation->id, 'name' => 'Internet']);
    }
}
