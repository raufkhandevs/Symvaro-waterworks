<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Umer Illyas',
            'is_super_admin' => true,
            'email' => 'umer@watermeter.co',
            'password' => Hash::make('t00r'),
            'email_verified_at' => now(),
        ]);
    }
}
