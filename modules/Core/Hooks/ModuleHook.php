<?php

namespace Modules\Core\Hooks;

class ModuleHook
{
    const AUTH = "Xác thực và ủy quyền";
    const CUSTOMER = "Người dùng";
    const CART = "Giỏ hàng";
    const SHOP = "Shop";
    const VENDOR = "Người bán";
    const ADMIN = "Quản trị viên";
    const PRODUCT = "Sản phẩm";
    const PROMOTION = "Khuyến mại";
    const DASHBOARD = "Trang quản trị";
    const ROLE = "Vai trò";
    const PERMISSION = "Uỷ quyền";
    const MODULES = [
        'dashboard'  => self::DASHBOARD,
        'auth'       => self::AUTH,
        'customer'   => self::CUSTOMER,
        'shop'       => self::SHOP,
        'cart'       => self::CART,
        'vendor'     => self::VENDOR,
        'product'    => self::PRODUCT,
        'admin'      => self::ADMIN,
        'promotion'  => self::PROMOTION,
        'role'       => self::ROLE,
        'permission' => self::PERMISSION,
    ];


}

