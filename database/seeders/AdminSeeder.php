<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@firdaus.com',
            'password' => Hash::make('&xY3wZ5!p'),
        ]);
    }
}