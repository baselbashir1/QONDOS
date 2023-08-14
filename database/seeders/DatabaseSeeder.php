<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Client;
use App\Models\MaintenanceTechnician;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456)
        ]);

        Client::create([
            'name' => 'client',
            'email' => 'client@gmail.com',
            'phone' => '0912345678',
            'city' => 'New York',
            'password' => bcrypt(123456)
        ]);

        MaintenanceTechnician::create([
            'name' => 'maintenance technician',
            'email' => 'maintenance.technician@gmail.com',
            'phone' => '0912345679',
            'city' => 'New York',
            'password' => bcrypt(123456)
        ]);
    }
}
