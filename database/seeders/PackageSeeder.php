<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Classic Pinoy Fiesta',
                'description' => "MAIN DISHES:\n- Pork Menudo Special\n- Chicken Adobo sa Gata\n- Mixed Vegetables with Quail Eggs\n\nDESSERT & DRINKS:\n- Buko Pandan Salad\n- Bottomless Iced Tea\n\nINCLUSIONS:\n- Steamed White Rice\n- Basic Floral Centerpiece\n- Standard Catering Setup",
                'price' => 350.00,
                'image_path' => 'packages/p1.jpg'
            ],
            [
                'name' => 'Grand Celebration Package',
                'description' => "MAIN DISHES:\n- Beef Caldereta with Cheese\n- Buttered Chicken with Gravy\n- Sweet and Sour Fish Fillet\n- Pancit Guisado (Special)\n\nDESSERT & DRINKS:\n- Leche Flan Special\n- Tropical Fruit Salad\n- Bottomless Lemonade\n\nINCLUSIONS:\n- Unlimited Rice\n- Themed Backdrop Setup\n- Complete Silverware and Glassware",
                'price' => 550.00,
                'image_path' => 'packages/p2.jpg'
            ],
            [
                'name' => 'Premium Wedding Buffet',
                'description' => "MAIN DISHES:\n- Roast Beef with Mushroom Sauce\n- Chicken Cordon Bleu\n- Baked Macaroni with White Sauce\n- Breaded Pork Chop with Apple Sauce\n\nDESSERT & DRINKS:\n- Cathedral Windows Gelatin\n- Mango Graham Float\n- Refillable Cucumber Juice\n\nINCLUSIONS:\n- Uniformed Waiters and Servers\n- Elegant Buffet Table Decoration\n- Gift and Cake Table Setup",
                'price' => 750.00,
                'image_path' => 'packages/p3.jpg'
            ],
            [
                'name' => 'Kiddie Party Special',
                'description' => "MAIN DISHES:\n- Sweet Style Spaghetti with Hotdog\n- Crispy Fried Chicken Wings\n- Pork Barbecue Sticks\n\nDESSERT & DRINKS:\n- Assorted Donuts & Cupcakes\n- Chocolate Fountain Station\n- Red Iced Tea / Orange Juice\n\nINCLUSIONS:\n- Colorful Balloons Setup\n- Kiddie Size Tables and Chairs\n- Name Tags for Guests",
                'price' => 450.00,
                'image_path' => 'packages/p4.jpg'
            ],
        ];

        DB::transaction(function () use ($data) {
            foreach ($data as $item) {
                Package::create($item);
            }
        });
    }
}
