<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin')
        ]);        
 
        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('user')
        ]);
    }
}