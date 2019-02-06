<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class LoginRequest extends Request
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
            'email'       => 'required',
            'password'       => 'required',
            'firebase_token'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "الايميل مطلوب",
            'password.required' => "كلمة المرور مطلوبة",
            'firebase_token.required' => "ال firebase token مطلوب"
        ];
    }
}
