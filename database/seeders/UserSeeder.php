<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoleId = Role::where('name', 'admin')->value('id');
        $userRoleId = Role::where('name', 'user')->value('id');

        User::firstOrCreate(
            ['email' => 'ismailbenmezi300@gmail.com'],
            [
                'name' => 'Ismail',
                'password' => Hash::make('ismailbenmezi300@gmail.com'),
                'role_id' => $adminRoleId,
                'is_banned' => false,
                'reputation' => 0,
            ]
        );

        User::firstOrCreate(
            ['email' => 'ismailbenmezi500@gmail.com'],
            [
                'name' => 'Ismail Ben',
                'password' => Hash::make('ismailbenmezi500@gmail.com'),
                'role_id' => $userRoleId,
                'is_banned' => false,
                'reputation' => 0,
            ]
        );

        User::firstOrCreate(
            ['email' => 'ismailbenmezi400@gmail.com'],
            [
                'name' => 'Member',
                'password' => Hash::make('ismailbenmezi400@gmail.com'),
                'role_id' => $userRoleId,
                'is_banned' => false,
                'reputation' => 0,
            ]
        );
    }
}
