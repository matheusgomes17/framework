<?php

namespace MVG\Units\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateProfileRequest
 *
 */
class UpdateProfileRequest extends FormRequest
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
            'first_name'  => 'required|max:191',
            'last_name'  => 'required|max:191',
            'email' => 'sometimes|required|email|max:191',
        ];
    }
}
