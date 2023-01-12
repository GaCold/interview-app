<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Api\LoginRequest;
use App\Services\Api\AuthService;
use Illuminate\Http\Request;

class AuthController extends BaseController
{

    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request->validated());
    }
}
