<?php

namespace Modules\Cart\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Cart\Models\Cart;
use Modules\Product\Models\Product;
use Illuminate\Support\Facades\DB;
class CartProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $index) {
            DB::table('cart_products')->insert([
                'product_variant_id'=> rand(1, Product::count()),
                'cart_id' => rand(1,Cart::count()),
                'quantity' => rand(1,100),
            ]);
        }
    }
}
