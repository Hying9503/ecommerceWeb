<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Wireless Headphones', 'description' => 'High quality sound', 'price' => 99.99, 'stock' => 20, 'image' => 'images/products/headphones.jpg'],
            ['name' => 'Mechanical Keyboard', 'description' => 'RGB backlit keyboard', 'price' => 149.99, 'stock' => 15, 'image' => 'images/products/keyboard.jpg'],
            ['name' => 'USB-C Hub', 'description' => '7-in-1 multiport hub', 'price' => 39.99, 'stock' => 50, 'image' => 'images/products/hub.jpg'],
            ['name' => 'Webcam 1080p', 'description' => 'Crystal clear video', 'price' => 79.99, 'stock' => 30, 'image' => 'images/products/webcam.jpg'],
            ['name' => 'Mouse Pad XL', 'description' => 'Extra large desk mat', 'price' => 24.99, 'stock' => 100, 'image' => 'images/products/mousepad.jpg'],
            ['name' => 'Monitor Stand', 'description' => 'Adjustable ergonomic stand', 'price' => 59.99, 'stock' => 25, 'image' => 'images/products/stand.jpg'],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }  
    }
}
