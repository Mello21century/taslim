<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'permission' => 1,
        ],
        [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('987654321'),
            'permission' => 2,
        ],
        [
            'name' => 'dilver',
            'email' => 'dilver@gmail.com',
            'password' => Hash::make('password123'),
            'permission' => 3,
        ],
        [
            'name' => 'store',
            'email' => 'store@gmail.com',
            'password' => Hash::make('password123'),
            'permission' => 4,
        ]
    );
    }
}
