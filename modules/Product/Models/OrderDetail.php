<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'variant_id',
        'quantity',
        'sale_price',
        'import_price',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
