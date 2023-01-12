<?php

namespace App\Http\Middleware;

use App\Traits\HasTransformer;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;

class VerifyJWTToken
{
    use HasTransformer;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        ;
        try {
            $user = JWTAuth::toUser($request->bearerToken());
            dd($user);
        } catch (JWTException $e) {
            dd( $e->getMessage());
            return $this->httpUnauthorized('Token invalid');
        }

        return $next($request);
    }
}
