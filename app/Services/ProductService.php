<?php

namespace App\Services;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Traits\HasTransformer;
use App\Transformers\ProductTransformer;

class ProductService extends BaseService
{
    use HasTransformer;

    public function __construct(ProductRepositoryInterface $repository, ProductTransformer $transformer)
    {
        parent::__construct($repository, $transformer);
    }
}