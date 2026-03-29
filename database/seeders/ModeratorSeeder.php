<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class ModeratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ModerTest1',
            'email' => 'modertest1@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'ModerTest2',
            'email' => 'postscriptum145@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
        ]);
        User::create([
            'name' => 'ModerTest3',
            'email' => 'polinasav04@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
        ]);
    }
}
