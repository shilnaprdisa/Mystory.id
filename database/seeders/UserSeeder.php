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
            'rating_score' => '0',
            'is_online' => false,
            'is_verified' => false,
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
            'rating_score' => '0',
            'is_online' => false,
            'is_verified' => false,
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
            'rating_score' => '0',
            'is_online' => false,
            'is_verified' => false,
            'password' => 'tentor',
            'remember_token' => uniqid()
        ]);
        User::create([
            'name' => 'Customer',
            'username' => 'Customer',
            'iso_code' => 'ID',
            'country_code' => '62',
            'phone' => '82149990077',
            'email' => 'customer@gmail.com',
            'role' => 'Customer',
            'status' => 'Active',
            'gender' => 'Male',
            'rating_score' => '0',
            'is_online' => false,
            'is_verified' => false,
            'password' => 'customer',
            'remember_token' => uniqid()
        ]);
    }
}
