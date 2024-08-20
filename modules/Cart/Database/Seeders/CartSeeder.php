<?php

namespace Modules\Cart\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Cart\Models\Cart;
use Illuminate\Support\Facades\DB;
class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 60) as $index) {
            DB::table('carts')->insert([
                'user_id' => 0 + $index,
            ]);
        }
    }
}
