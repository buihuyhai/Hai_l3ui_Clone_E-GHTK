<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    /**
     * @return BelongsToMany
     */
    public function shop() : BelongsToMany
    {
        return $this->belongsToMany(Shop::class, 'owner_shop','user_id','shop_id');
    }
}
