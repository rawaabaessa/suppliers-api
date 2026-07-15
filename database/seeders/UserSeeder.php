<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::insert([
            [
                'name' => 'Ahmed Ali',
                'email' => 'resturant@test.com',
                'password' => Hash::make('123456789'),
                'role_id' => 3,
            ],
            [
                'name' => 'Mohammed Saleh',
                'email' => 'resturant2@test.com',
                'password' => Hash::make('123456789'),
                'role_id' => 3,
            ],
            [
                'name' => 'Ali Hassan',
                'email' => 'resturant3@test.com',
                'password' => Hash::make('123456789'),
                'role_id' => 3,
            ],
        ]);
    }
}
