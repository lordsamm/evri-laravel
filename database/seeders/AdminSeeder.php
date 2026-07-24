<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'mrsat69'],
            [
                'name' => 'Admin',
                'username' => 'mrsat69',
                'email' => 'admin@evri.local',
                'password' => Hash::make('sam123el'),
            ]
        );
    }
}
