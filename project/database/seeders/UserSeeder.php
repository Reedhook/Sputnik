<?php

namespace project\database\seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'last_name' => 'Laravelia',
            'first_name' => 'Laravelia',
            'email' => 'laravelia@web.com',
            'is_admin' =>false,
        ]);
    }
}
