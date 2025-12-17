<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Specific Users
        // Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '1', // Admin
            'phone' => '1234567890',
            'address' => 'Admin HQ, New York, USA'
        ]);

        // Regular User
        User::create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => '0', // Customer
            'phone' => '0987654321',
            'address' => '123 Street, City, Country'
        ]);

        // 2. Create Categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Gadgets and devices', 'image' => 'laptop.jpg'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'description' => 'Men and Women clothing', 'image' => 'shirt.jpg'],
            ['name' => 'Home & Furniture', 'slug' => 'home-furniture', 'description' => 'Sofa, Chairs and Decor', 'image' => 'sofa.jpg'],
            ['name' => 'Beauty', 'slug' => 'beauty', 'description' => 'Makeup and Skincare', 'image' => 'shirt.jpg'], // Reusing image
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Gym and Outdoor equipment', 'image' => 'laptop.jpg'], // Reusing image
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'description' => $cat['description'],
                'image' => $cat['image'],
                'meta_title' => $cat['name'],
                'meta_keyword' => $cat['name'],
                'meta_description' => $cat['description'],
                'status' => '1',
            ]);
        }

        // 3. Create 50 Dummy Products
        $faker_titles_electronics = ['Pro Laptop 2024', 'Gaming Mouse', 'Wireless Headset', '4K Monitor', 'Smartphone X', 'Mechanical Keyboard'];
        $faker_titles_fashion = ['Cotton T-Shirt', 'Denim Jeans', 'Leather Jacket', 'Summer Dress', 'Sneakers', 'Formal Shirt'];
        
        for ($i = 1; $i <= 50; $i++) {
            $cat_id = rand(1, 5); // Pick random category
            
            // Choose image based on category for slight realism
            $img = 'laptop.jpg'; 
            if($cat_id == 2 || $cat_id == 4) $img = 'shirt.jpg';
            if($cat_id == 3) $img = 'sofa.jpg';

            Product::create([
                'category_id' => $cat_id,
                'name' => 'Product Item #' . $i,
                'slug' => 'product-item-' . $i,
                'small_description' => 'This is a short description for product #' . $i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'original_price' => rand(100, 500),
                'selling_price' => rand(50, 450),
                'quantity' => rand(10, 100),
                'trending' => rand(0, 1) ? '1' : '0',
                'status' => '0', // Visible
                'meta_title' => 'Product #' . $i,
                'meta_keyword' => 'shopping',
                'meta_description' => 'Best product',
                'image' => $img, // Using the dummy image filenames
            ]);
        }

        // 4. Create Dummy Orders (For Dashboard Analytics)
        for ($i = 1; $i <= 20; $i++) {
            $order = Order::create([
                'user_id' => 2, // Assign to "user@gmail.com"
                'tracking_no' => 'ORD-' . rand(11111, 99999),
                'fullname' => 'Test User',
                'email' => 'user@gmail.com',
                'phone' => '0987654321',
                'address' => '123 Street, City',
                'status_message' => rand(0, 3) == 3 ? 'completed' : 'in progress', // Simple status logic
                'payment_mode' => rand(0, 1) ? 'COD' : 'Paid by Stripe',
                'payment_id' => rand(0, 1) ? 'pay_'.rand(111,999) : null,
                'total_price' => rand(100, 1000), // Random placeholder total
                'created_at' => Carbon::today()->subDays(rand(0, 30)), // Spread dates over last 30 days
            ]);

            // Add fake items to this order
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => rand(1, 20),
                'qty' => rand(1, 3),
                'price' => rand(50, 200),
            ]);
        }
    }
}