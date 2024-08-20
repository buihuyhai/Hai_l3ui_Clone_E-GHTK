<?php

namespace Modules\Auth\Helpers;

class PermissionHelper
{
    protected static $all = [];

    protected static $is_init = false;

    public static function all() {
        if(!static::$is_init){
            static::load();
        }
        return static::$all;
    }

    public static function load() {
        static::$all = config('permissions');
        static::$is_init = true;
    }

}
