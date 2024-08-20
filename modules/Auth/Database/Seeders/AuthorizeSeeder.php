<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Auth\Hooks\RoleHook;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Modules\Auth\Helpers\RoleHelper;

class AuthorizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $sudo = Role::create([
            'name'  => RoleHook::SUPER_ADMIN,
            'title' => RoleHook::SUPER_ADMIN_TRANSLATION,
        ]);

        $admin = Role::create([
            'name'  => RoleHook::ADMIN,
            'title' => RoleHook::ADMIN_TRANSLATION,
        ]);

        $vendor = Role::create([
            'name'  => RoleHook::VENDOR,
            'title' => RoleHook::VENDOR_TRANSLATION,
        ]);

        $user = Role::create([
            'name'  => RoleHook::CUSTOMER,
            'title' => RoleHook::CUSTOMER_TRANSLATION,
        ]);

        foreach (config("permissions.role") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
        }

        foreach (config("permissions.permission") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
        }

        foreach (config("permissions.customer") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
        }


        foreach (config("permissions.vendor") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
        }


        foreach (config("permissions.admin") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
        }


        foreach (config("permissions.product") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
            $vendor->givePermissionTo($permission);
        }


        foreach (config("permissions.shop") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
            $vendor->givePermissionTo($permission);
        }


        foreach (config("permissions.cart") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
        }

        foreach (config("permissions.promotion") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
            $vendor->givePermissionTo($permission);
        }

        foreach (config("permissions.dashboard") as $permission => $title) {
            Permission::create([
                'name'  => $permission,
                'title' => $title
            ]);
            $sudo->givePermissionTo($permission);
            $admin->givePermissionTo($permission);
        }

    }
}
