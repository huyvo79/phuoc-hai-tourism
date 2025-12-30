<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',       // Theo thiết kế bảng users 
            'name' => 'Quản Trị Viên',
            'password' => Hash::make('123456'), // Mật khẩu hash
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}