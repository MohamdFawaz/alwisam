<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageSettingsRequest.
 */
class AdminChangePasswordRequest extends FormRequest
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
            'password'       => 'required',
            'confirm_password'       => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
         //
        ];
    }
}
