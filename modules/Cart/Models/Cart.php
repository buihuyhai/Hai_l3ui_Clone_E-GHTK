<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Cart\Database\factories\CartFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\ProductVariant;
use Modules\User\Models\User;
class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(ProductVariant::class, 'cart_products', 'cart_id', 'product_variant_id')
            ->withPivot('quantity');
    }
    protected static function newFactory(): Factory
    {
        return CartFactory::new();
    }
}
