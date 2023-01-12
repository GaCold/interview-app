<?php

namespace App\Services\Api;

use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Services\BaseService;
use App\Traits\HasTransformer;
use App\Transformers\ProductTransformer;
use App\Transformers\UserTransformer;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends BaseService
{
    use HasTransformer;

    public function __construct(UserRepositoryInterface $repository, UserTransformer $transformer)
    {
        parent::__construct($repository, $transformer);
    }

    public function login($params)
    {
        if (!$token = JWTAuth::attempt($params)) {
            return $this->httpUnauthorized('invalid_credentials');
        }

        return $this->httpOk([
            'token' => $token
        ]);
    }
}