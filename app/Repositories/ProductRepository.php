<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use Spatie\QueryBuilder\Filter;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->allowedFilters = [
            Filter::scope('price'),
        ];
    }
}
