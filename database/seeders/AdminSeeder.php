<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Abirami',
            'email' => 'abirami@gmail.com',
            'password' => 'admin',
            'is_admin' => true,
            'phone_number' => '0771234567',
            'address' => 'Jaffna',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
