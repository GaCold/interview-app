<?php

namespace App\Exceptions;

use App\Traits\HasTransformer;
use Exception;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    use HasTransformer;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param           $request
     * @param Exception $exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            if ($exception->getPrevious() instanceof TokenExpiredException) {
                return $this->httpUnauthorized(__('Token expired'));
            }
            else if ($exception->getPrevious() instanceof TokenInvalidException) {
                return $this->httpUnauthorized(__('Token invalid'));
            }
            else if ($exception->getPrevious() instanceof TokenBlacklistedException) {
                return $this->httpUnauthorized(__('Token blacklisted'));
            } else {
                return $this->httpUnauthorized(__('Token invalid'));
            }
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->httpNotFound();
        }


        if ($this->isHttpException($exception)) {
            switch (true) {
                case $exception instanceof HttpException:
                    return $this->httpBadRequest($exception);
                case $exception instanceof NotFoundHttpException:
                case $exception instanceof ModelNotFoundException:
                    return response()->view('error.' . '404', [], 404);
                case $exception instanceof BadRequestHttpException:
                    return $this->httpBadRequest($exception->getMessage());
                case $exception instanceof AuthorizationException:
                case $exception instanceof AuthenticationException:
                    return $this->httpUnauthorized($exception->getMessage());
                default:
                    return $this->renderCustomErrorException($exception);
            }
        }

        return parent::render($request, $exception);
    }

    private function renderCustomErrorException($exception): \Illuminate\Http\JsonResponse
    {
        $errorMessage = 'Invalid request';
        try {
            $errorCode = $exception->getStatusCode();
        } catch (\Throwable $th) {
            $errorCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json([
            'status' => $errorCode,
            'success' => false,
            'error' => [
                'code' => $errorCode,
                'message' => $errorMessage,
            ],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
