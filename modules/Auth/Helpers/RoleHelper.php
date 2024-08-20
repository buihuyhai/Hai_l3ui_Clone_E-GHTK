<?php

namespace Modules\Auth\Helpers;

class RoleHelper
{
    public static function formatRoleName($name)
    {
        return ucwords(str_replace('_', ' ', $name));
    }




}


