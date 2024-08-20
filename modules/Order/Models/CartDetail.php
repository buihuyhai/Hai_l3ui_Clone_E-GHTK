<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_products';

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id','id');
    }


}
