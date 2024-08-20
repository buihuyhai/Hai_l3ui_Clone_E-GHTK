<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Models\User;
use Modules\Auth\Hooks\RoleHook;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(25)
            ->create()
            ->each(function ($user) {
                $user->assignRole(RoleHook::CUSTOMER);
            });

        User::factory(20)
            ->create()
            ->each(function ($user) {
                $user->assignRole(RoleHook::VENDOR);
            });

        User::factory(15)
            ->create()
            ->each(function ($user) {
                $user->assignRole(RoleHook::ADMIN);
            });

        $sudo = User::factory()->create([
            'name'  => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        $sudo->assignRole(RoleHook::SUPER_ADMIN);


    }
}
