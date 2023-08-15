<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'name' => 'client',
            'email' => 'client@gmail.com',
            'phone' => '0912345678',
            'city' => 'New York',
            'password' => bcrypt(123456)
        ]);
    }
}
