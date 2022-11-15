<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'SuperAdmin',
            'iso_code' => 'ID',
            'country_code' => '62',
            'phone' => '82158863345',
            'email' => 'fajar2943@gmail.com',
            'role' => 'Super',
            'status' => 'Active',
            'gender' => 'Male',
            'is_online' => false,
            'is_verified' => true,
            'password' => 'super',
            'remember_token' => uniqid()
        ]);
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'iso_code' => 'ID',
            'country_code' => '62',
            'phone' => '821444555667',
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'status' => 'Active',
            'gender' => 'Male',
            'is_online' => false,
            'is_verified' => true,
            'password' => 'admin',
            'remember_token' => uniqid()
        ]);
        User::create([
            'name' => 'Tentor',
            'username' => 'Tentor',
            'iso_code' => 'ID',
            'country_code' => '62',
            'phone' => '821444555878',
            'email' => 'tentor@gmail.com',
            'role' => 'Tentor',
            'status' => 'Active',
            'gender' => 'Male',
            'is_online' => false,
            'is_verified' => true,
            'password' => 'tentor',
            'remember_token' => uniqid()
        ]);
        User::create([
            'name' => 'Student',
            'username' => 'Student',
            'iso_code' => 'ID',
            'country_code' => '62',
            'phone' => '82149990077',
            'email' => 'student@gmail.com',
            'role' => 'Student',
            'status' => 'Active',
            'gender' => 'Male',
            'is_online' => false,
            'is_verified' => true,
            'password' => 'student',
            'remember_token' => uniqid()
        ]);
    }
}
