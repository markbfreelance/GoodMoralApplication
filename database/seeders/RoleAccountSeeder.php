<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;  // Correct place for the 'use' statement

class RoleAccountSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_account')->insert([
            [
                'email' => 'student1@example.com',
                'student_id' => 'S12345',
                'password' => Hash::make('password123'),  // Using Hash::make to hash the password
                'account_type' => 'Student',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'student2@example.com',
                'student_id' => 'S12346',
                'password' => Hash::make('password123'),
                'account_type' => 'Student',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
