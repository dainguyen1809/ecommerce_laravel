<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'Admin User',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Vendor',
                'username' => 'Vendor User',
                'email' => 'vendor@gmail.com',
                'role' => 'vendor',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User',
                'username' => 'User',
                'email' => 'hehe@gmail.com',
                'role' => 'user',
                'status' => 'active',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
