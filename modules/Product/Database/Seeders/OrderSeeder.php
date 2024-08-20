<?php
namespace Modules\Product\Database\Seeders;
use Carbon\Carbon;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orderIds = [];
        foreach (range(1, 2) as $index) {           
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => 1,
                'shop_id' => fake()->numberBetween(1,2),
                'discount' => fake()->numberBetween(1000, 1000000),
                'final_cost' =>fake()->numberBetween(1000,1000000),
                'order_date' => now(),
                'email' => "fake_email@gmail.com",
                'address' => fake()->address(),
                'phone_number' => fake()->phoneNumber(),
                'description' => fake()->sentence(),
                'status' => fake()->numberBetween(0,2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $orderIds[] = $orderId;
        }
        foreach ($orderIds as $orderId) {
            foreach (range(1, fake()->numberBetween(1,2)) as $index) {
                DB::table('order_detail')->insert([
                    'order_id' => $orderId,
                    'variant_id' => fake()->numberBetween(1, 149),
                    'quantity' => fake()->numberBetween(1,10),
                    'import_price' => fake()->numberBetween(1000, 10000000),
                    'sale_price' => fake()->numberBetween(1000, 10000000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
