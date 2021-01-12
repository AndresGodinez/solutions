<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOldPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required',
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
    public function messages(): array
    {
        return [
            'old_password.required' => 'El campo password es requerido',
            'new_password_confirm.required' => 'El campo password es requerido',
            'new_password.min' => 'El campo password debe de tener mínimo 10 caracteres',
            'new_password.regex' => 'El password debe de contener: mínimo 1 carácter en minuscula, 1 carácter en mayúscula, 1 carácter numérico, 1 carácter especial',
        ];
    }

}
