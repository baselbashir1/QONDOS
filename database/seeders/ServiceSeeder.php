<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use App\Http\Enums\CategoryType;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'type' => CategoryType::service,
            'en' => [
                'name' => 'First service'
            ],
            'ar' => [
                'name' => 'الخدمة الأولى'
            ],
            'sub_category_id' => SubCategory::find(1)->id
        ]);
    }
}
