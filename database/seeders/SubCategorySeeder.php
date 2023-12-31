<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use App\Http\Enums\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'type' => CategoryType::subCategory,
            'en' => [
                'name' => 'First sub category'
            ],
            'ar' => [
                'name' => 'التصنيف الفرعي الأول'
            ],
            'category_id' => Category::find(1)->id
        ]);

        SubCategory::create([
            'type' => CategoryType::subCategory,
            'en' => [
                'name' => 'Second sub category'
            ],
            'ar' => [
                'name' => 'التصنيف الفرعي الثاني'
            ],
            'category_id' => Category::find(1)->id
        ]);

        SubCategory::create([
            'type' => CategoryType::subCategory,
            'en' => [
                'name' => 'Third sub category'
            ],
            'ar' => [
                'name' => 'التصنيف الفرعي الثالث'
            ],
            'category_id' => Category::find(2)->id
        ]);
    }
}
