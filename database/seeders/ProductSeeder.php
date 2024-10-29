<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Get all category IDs
        $categoryIds = Category::pluck('id')->toArray();

        // Seed 30 products with random categories
        for ($i = 0; $i < 30; $i++) {
            Product::create([
                'ean' => $faker->unique()->numberBetween(1000000000000, 9999999999999),
                'name' => $faker->word . ' ' . $faker->word,
                'description' => $faker->text(300),
                'price' => $faker->randomFloat(2, 29, 1200),
                'category_id' => $faker->randomElement($categoryIds),
                'stock' => $faker->numberBetween(3, 500)
            ]);
        }
    }
}
