<?php

namespace App\Http\Requests\Recipients;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => ['required'],
            'nip' => ['required'],
            'account_number' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'street' => ['required'],
            'post_code' => ['required'],
            'city' => ['required'],
        ];
    }
}
