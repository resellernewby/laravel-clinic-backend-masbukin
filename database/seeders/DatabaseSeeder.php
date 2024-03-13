<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProfileClinic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        ProfileClinic::create([
            'name' => 'Masbukin Clinic',
            'address' => 'Jl. Palka 15, Bantarwaru Cinangka Serang',
            'phone' => '0877387388377',
            'email' => 'dr.johndoe@gmail.com',
            'doctor_name' => 'Dr. John doe',
            'unique_code' => 'NHD293790',
        ]);
    }
}
