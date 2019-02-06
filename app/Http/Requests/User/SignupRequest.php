<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class SignupRequest extends Request
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => "رقم الهاتف مطلوب",
            'password.required' => "كلمة المرور مطلوبة",
            'first_name.required' => "الاسم الاول مطلوب",
            'last_name.required' => "الاسم الاخير مطلوب",
            'email.required' => "البريد الاكتروني مطلوب"
        ];
    }
}
