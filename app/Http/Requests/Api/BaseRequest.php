<?php

namespace App\Http\Requests\Api;

use App\Traits\HasTransformer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BaseRequest extends FormRequest
{
    use HasTransformer;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY,
            'success' => false,
            'message' => __('Validation errors'),
            'data'    => $validator->errors(),
        ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY));
    }

}
