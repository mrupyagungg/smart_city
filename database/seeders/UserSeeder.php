<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Elouis',
            'email' => 'el@admin.com',
            'password' => Hash::make('password'), // Enkripsi password
        ]);

        User::create([
            'name' => 'Dara',
            'email' => 'dara@admin.com',
            'password' => Hash::make('password2'),
        ]);
        
        User::create([
            'name' => 'Guntur',
            'email' => 'guntur@admin.com',
            'password' => Hash::make('password3'),
        ]);
    }
}