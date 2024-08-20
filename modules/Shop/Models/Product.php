<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Product\Models\Category;
use Modules\Product\Models\ProductVariant;
use Modules\Shop\DTO\Request\SearchProductRequest;
use Modules\Shop\Helpers\BelongToShopTrait;
use MongoDB\Driver\Query;

class Product extends Model
{
    use HasFactory;
    use BelongToShopTrait;

    /**
     * @var string
     */
    protected $table = 'products';
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'sale_price',
        'short_desc',
        'desciption',
        'rating',
        'sold',
        'slug',
        'thumbnail',
        'category_id',
        'shop_id',
        'user_created',
        'user_updated'
    ];

    /**
     * @return HasMany
     */
    public function variants() : HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    /**
     * @param $query
     * @param SearchProductRequest $searchParam
     * @return mixed
     */
    public function scopeWithFilter($query, SearchProductRequest $searchParam): mixed
    {
        if ($searchParam->getName()){
            $query->where('name', 'like', '%'. $searchParam->getName(). '%');
        }

        if ($searchParam->getCategory()){
            $query->where('category_id', '=', $searchParam->getCategory());
        }
        return $query;
    }

    /**
     * @return string
     */
    public function getCategoryNameAttribute(): string
    {
        return $this->category->name ?? "unknown";
    }

}
