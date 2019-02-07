<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class ForgotPasswordRequest extends Request
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
            'new_password'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => trans('validation.phone'),
        ];
    }
}
