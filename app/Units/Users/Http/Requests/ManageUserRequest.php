<?php

namespace MVG\Units\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageUserRequest
 * @package MVG\Units\Users\Http\Requests
 */
class ManageUserRequest extends FormRequest
{
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
        return [

        ];
    }
}