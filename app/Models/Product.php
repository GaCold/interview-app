<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuid;

    protected $fillable = [
        'product_code',
        'product_name',
        'price',
        'image_path',
    ];

    public function scopePrice($query, $value)
    {
        return $query->whereBetween('price', request()->input('filter.price'));
    }
}
