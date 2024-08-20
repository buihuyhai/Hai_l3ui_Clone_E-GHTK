<?php

namespace Modules\Promotion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Modules\Shop\DTO\Request\SearchProductRequest;

use MongoDB\Driver\Query;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $fillable = [
        'id',
        'code',
        'value',
        'percent',
        'from',
        'total',
        'used',
        'start_date',
        'expired_date',
    ];

}
