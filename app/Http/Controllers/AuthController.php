<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect(route('products.index'));
        }
        return view('auth.login');
    }

    public function logout()
    {
        auth()->logout();

        return redirect(route('login'));
    }

    public function handleLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->validated(), $request->input('is_remember', 0))) {
            return redirect(route('products.index'));
        }

        session()->flash('error', 'Login Failed');

        return back();
    }
}
