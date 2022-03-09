<?php

namespace App\Http\Requests\ClientBankAccounts;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','max:100'],
            'bank_name' => ['required','max:100'],
            'currency_id' => ['required','numeric','max:100'],
            'account_number' => ['required','iban'],
            'swift' => ['required','bic']
        ];
    }
}
