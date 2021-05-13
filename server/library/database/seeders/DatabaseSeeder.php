<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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