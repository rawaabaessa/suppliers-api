<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::insert([
            [
                'name' => 'Apple',
                'description' => 'Fresh apples',
                'farmer_id' => 1,
                'category_id' => 1,
                'price' => 12,
                'min_order' => 5,
                'quantity' => 240,
                'image' => 'products/apple.jpg',
            ],
            [
                'name' => 'Tomato',
                'description' => 'Organic tomatoes',
                'farmer_id' => 1,
                'category_id' => 2,
                'price' => 6,
                'min_order' => 10,
                'quantity' => 500,
                'image' => 'products/tomato.jpg',
            ],
            [
                'name' => 'Potato',
                'description' => 'Fresh potatoes',
                'farmer_id' => 2,
                'category_id' => 3,
                'price' => 4,
                'min_order' => 20,
                'quantity' => 700,
                'image' => 'products/potato.jpg',
            ],
            [
                'name' => 'Cucumber',
                'description' => 'Green cucumbers',
                'farmer_id' => 2,
                'category_id' => 2,
                'price' => 5,
                'min_order' => 10,
                'quantity' => 150,
                'image' => 'products/cucumber.jpg',
            ],
            [
                'name' => 'Lemon',
                'description' => 'Fresh lemons',
                'farmer_id' => 3,
                'category_id' => 1,
                'price' => 8,
                'min_order' => 5,
                'quantity' => 300,
                'image' => 'products/lemon.jpg',
            ],
        ]);
    }
}
