<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Models\Product;
use Modules\Shop\Enum\StatusShopEnum;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'shops';
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone_number',
        'email',
        'logo_url',
        'is_confirmed',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * @return BelongsToMany
     */
    public function owner() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'owner_shop','shop_id','user_id');
    }

    /**
     * @return string
     */
    public function getStatusNameAttribute(): string
    {
        return match ($this->status) {
            StatusShopEnum::STATUS_OPEN => 'open',
            StatusShopEnum::STATUS_CLOSE => 'closed',
            StatusShopEnum::STATUS_LOCKED => 'locked',
            default => 'unknown',
        };
    }
}
