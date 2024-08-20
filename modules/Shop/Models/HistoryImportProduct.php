<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Product\Models\ProductVariant;

class HistoryImportProduct extends Model
{
    use HasFactory;
    protected $table = 'history_import';
    protected $fillable = [
        'product_variant_id',
        'number',
        'type',
    ];

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class,'product_variant_id', 'id');
    }
}
