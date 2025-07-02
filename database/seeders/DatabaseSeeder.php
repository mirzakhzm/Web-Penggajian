<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Suroboyo',
            'email' => 'suro@gmail.com',
            'first_name' => 'Suro',
            'last_name' => 'Boyo',
            'password' => Hash::make('Test1234'), 
            'role' => 'Finance'
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'first_name' => 'Manager',
            'last_name' => 'test',
            'password' => Hash::make('Manager1234'),
            'role' => 'Manager'
        ]);

        User::factory()->create([
            'name' => 'Director',
            'email' => 'director@gmail.com',
            'first_name' => 'Director',
            'last_name' => 'test',
            'password' => Hash::make('Director1234'),
            'role' => 'Director'
        ]);
    }
}
