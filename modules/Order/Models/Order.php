<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\DTO\Request\SearchOrderRequest;
use Modules\Order\Enum\StatusOrderEnum;
use Modules\Shop\Helpers\BelongToShopTrait;
use Modules\Shop\Models\Shop;
use Modules\Shop\Models\User;

class Order extends Model
{
    use HasFactory;
    use BelongToShopTrait;
    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'shop_id',
        'discount',
        'final_cost',
        'order_date',
        'email',
        'address',
        'phone_number',
        'description',
        'status'
    ];

    public function shop():BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function detail() : HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }

    public function scopeWithFilter($query,SearchOrderRequest $request)
    {
        if ($request->getStatus()){
            $query->where('status', $request->getStatus());
        }

        return $query;
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->name ?? "unknown";
    }

    public function getStatusNameAttribute()
    {
        return match ($this->status) {
            StatusOrderEnum::STATUS_REJECT => 'rejected',
            StatusOrderEnum::STATUS_PENDING => 'pending',
            StatusOrderEnum::STATUS_CONFIRMED => 'confirmed',
            default => 'unknown',
        };
    }


}
