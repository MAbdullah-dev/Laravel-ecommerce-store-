<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            ['name' => 'Home & Kitchen'],
            ['name' => 'Books'],
            ['name' => 'Toys & Games'],
            ['name' => 'Beauty & Personal Care'],
            ['name' => 'Sports & Outdoors'],
            ['name' => 'Automotive'],
            ['name' => 'Health & Wellness'],
            ['name' => 'Music Instruments'],
            ['name' => 'Office Supplies'],
            ['name' => 'Garden & Outdoors'],
            ['name' => 'Grocery'],
            ['name' => 'Pet Supplies'],
            ['name' => 'Baby Products'],
            ['name' => 'Jewelry'],
            ['name' => 'Shoes'],
            ['name' => 'Clothing'],
            ['name' => 'Handbags'],
            ['name' => 'Watches'],
            ['name' => 'Furniture'],
            ['name' => 'Art & Crafts'],
            ['name' => 'Industrial & Scientific'],
            ['name' => 'Travel Accessories'],
            ['name' => 'Software'],
            ['name' => 'Video Games'],
            ['name' => 'Movies & TV'],
            ['name' => 'Appliances'],
            ['name' => 'Tools & Home Improvement'],
            ['name' => 'Camera & Photo']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
