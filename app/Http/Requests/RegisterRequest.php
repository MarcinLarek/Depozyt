<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'unique:users', 'min:6'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:6','confirmed'],
            'password_confirmation' => ['required'],
            'country_id' => ['required'],
            'client_type_id' => ['required'],
            'terms-and-conditions' => ['required']
        ];
    }
}
