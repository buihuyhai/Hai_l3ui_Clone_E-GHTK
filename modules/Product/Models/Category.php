<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'descprition',
        'thumbnail'
    ];

    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

}
