<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "role" => "admin",
            "password" => "password",
        ]);

        User::create([
            "name" => "User",
            "email" => "operator@gmail.com",
            "role" => "user",
            "password" => "123456",
            ]); 
    }
}


