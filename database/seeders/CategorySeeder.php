<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => '食べ物'],
            ['name' => 'フィギュア'],
            ['name' => 'ぬいぐるみ'],
            ['name' => '雑貨'],
            ['name' => 'その他'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}