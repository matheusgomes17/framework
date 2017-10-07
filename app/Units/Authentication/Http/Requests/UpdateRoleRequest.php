<?php

namespace MVG\Units\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRoleRequest
 * @package MVG\Units\Authentication\Http\Requests
 */
class UpdateRoleRequest extends FormRequest
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
            'name' => 'required|max:191',
        ];
    }
}