<?php

namespace Modules\Promotion\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $index) {
            DB::table('coupons')->insert([
                'code' =>'coupon'.$index,
                'value' => rand(1000,20000),
                'percent' => rand(1,100),
                'from' => rand(0,1000),
                'total' => rand(50,100),
                'used'=> rand(0,20),
                'start_date'=>now(),
                'expired_date'=> now()->addYears(1),
            ]);
        }
    }
}
