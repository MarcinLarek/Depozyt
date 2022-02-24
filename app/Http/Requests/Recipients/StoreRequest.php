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
            'nip' => ['required', 'NIP'],
            'account_number' => 'required',
            'bank_name' => ['required','max:100'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'street' => ['required'],
            'post_code' => ['required','post_code'],
            'city' => ['required'],
        ];
    }
}
