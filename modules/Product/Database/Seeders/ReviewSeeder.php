<?php
namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 50) as $index) {
            DB::table("reviews")->insert([
                'rating' => fake()->numberBetween(1, 5),
                'comment' => fake()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
                'user_created' => fake()->numberBetween(1, 10),
                'variant_id' => fake()->numberBetween(1, 148),
                'product_id' => $index
            ]);
        }
    }
}