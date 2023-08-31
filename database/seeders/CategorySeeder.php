<?php

namespace Database\Seeders;

use App\Http\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'type' => CategoryType::mainCategory,
            'en' => [
                'name' => 'First main category'
            ],
            'ar' => [
                'name' => 'التصنيف الرئيسي الأول'
            ]
        ]);

        Category::create([
            'type' => CategoryType::mainCategory,
            'en' => [
                'name' => 'Second main category'
            ],
            'ar' => [
                'name' => 'التصنيف الرئيسي الثاني'
            ]
        ]);
    }
}
