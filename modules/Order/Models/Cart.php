<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Product\Models\ProductVariant;

class Cart extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'carts';

    /**
     * @return HasMany
     */
    public function cartDetail(): HasMany
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function productVariant(): BelongsToMany
    {
        return $this->belongsToMany(ProductVariant::class, 'cart_products', 'cart_id', 'product_variant_id')
            ->withPivot('quantity');
    }

}
