<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Services\ProductService;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }

    public function index()
    {
        return parent::index();
    }
}
