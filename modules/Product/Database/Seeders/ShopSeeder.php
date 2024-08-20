<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    public function run()
    {
        $defaultLogo = "avatars/default.png";
        foreach (range(1, 20) as $index) {
            $id = DB::table("shops")->insertGetId([
                'name'         => fake()->name,
                'description'  => 'Cửa hàng tuyệt vời nhất e-ghtk!',
                'phone_number' => "0123456789",
                'email'        => fake()->email(),
                'address'      => fake()->address,
                'logo_url'     => $defaultLogo,
                'is_confirmed' => 1,
                'status'       => 0,
                'created_at'   => now(),
                'updated_at'   => now(),
                'created_by'   => $index,
                'updated_by'   => $index,
            ]);
            DB::table('owner_shop')->insert([
                "shop_id" => $id,
                "user_id" => $index,
            ]);
        }


    }
}
