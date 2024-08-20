<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Cart\Models\Cart;
use Modules\Shop\Models\HistoryImportProduct;


class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'name',
        'import_price',
        'price',
        'sale_price',
        'stock',
        'media_id',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    // public function media()
    // {
    //     return $this->belongsTo(Media::class, 'media_id', 'id');
    // }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products', 'product_variant_id', 'cart_id')
            ->withPivot('quantity');
    }

    public function historyImport(): HasMany
    {
        return $this->hasMany(HistoryImportProduct::class,'product_variant_id', 'id');
    }

}
