<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait HasTransformer
{
    /**
     * @param $message
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpBadRequest($message = null, int $code = ResponseAlias::HTTP_BAD_REQUEST): \Illuminate\Http\JsonResponse
    {
        return responder()->error($code, $message)->respond(ResponseAlias::HTTP_BAD_REQUEST);
    }

    /**
     * @param $data
     * @param $transformer
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpOk($data = null, $transformer = null, int $code = ResponseAlias::HTTP_OK): \Illuminate\Http\JsonResponse
    {
        return responder()->success($data, $transformer)->respond($code);
    }

    /**
     * @param $data
     * @param $transformer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpCreated($data = null, $transformer = null): \Illuminate\Http\JsonResponse
    {
        return responder()->success($data, $transformer)->respond(ResponseAlias::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpNoContent(): \Illuminate\Http\JsonResponse
    {
        return responder()->success()->respond(ResponseAlias::HTTP_NO_CONTENT);
    }

    /**
     * @param int    $code
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpNotFound(int $code = ResponseAlias::HTTP_NOT_FOUND, string $message = 'Data not found'): \Illuminate\Http\JsonResponse
    {
        return responder()->error($code, $message)->respond(ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * @param string $message
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpForbidden(string $message = 'unauthorized', int $code = ResponseAlias::HTTP_FORBIDDEN): \Illuminate\Http\JsonResponse
    {
        return responder()->error($code, $message)->respond(ResponseAlias::HTTP_FORBIDDEN);
    }

    /**
     * @param string $message
     * @param int    $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function httpUnauthorized(string $message = 'Unauthorized', int $code = ResponseAlias::HTTP_UNAUTHORIZED): \Illuminate\Http\JsonResponse
    {
        return responder()->error($code, $message)->respond(ResponseAlias::HTTP_UNAUTHORIZED);
    }

    protected function failedValidation($dataError): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => ResponseAlias::HTTP_BAD_REQUEST,
            'success' => false,
            'message' => __('Validation errors'),
            'data'    => $dataError,
        ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
    }
}