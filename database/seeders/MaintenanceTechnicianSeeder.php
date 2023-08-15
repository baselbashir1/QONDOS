<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaintenanceTechnician;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaintenanceTechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceTechnician::create([
            'name' => 'maintenance technician',
            'email' => 'maintenance.technician@gmail.com',
            'phone' => '0912345679',
            'city' => 'New York',
            'password' => bcrypt(123456)
        ]);
    }
}
