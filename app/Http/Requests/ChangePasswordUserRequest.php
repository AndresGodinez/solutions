<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordUserRequest extends FormRequest
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
            'new_password_confirm' => 'required',
            'new_password' => [
                'required',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => 'El campo password es requerido',
            'new_password.min' => 'El campo password debe de tener mínimo 10 caracteres',
            'new_password.regex' => 'El password debe de contener: mínimo 1 carácter en minuscula, 1 carácter en mayúscula, 1 carácter numérico, 1 carácter especial',
//            'new_password.regex:/[a-z]/' => 'El campo password debe de tener mínimo 1 carácter en minuscula',
//            'new_password.regex:/[A-Z]/' => 'El campo password debe de tener mínimo 1 carácter en mayúscula',
//            'new_password.regex:/[0-9]/' => 'El campo password debe de tener mínimo 1 carácter numérico',
//            'new_password.regex:/[@$!%*#?&]/' => 'El campo password debe de tener mínimo 1 carácter especial',
        ];
    }

}
