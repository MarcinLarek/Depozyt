<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CompanyDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $authorize = false;
        if (Auth::user()) {
            $authorize = true;
        }
        return $authorize;
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
          'nip' => ['required','NIP'],
          'regon' => ['required','REGON'],
          'krs' => ['required','max:100'],
          'email' => ['required','email','max:100'],
          'phone_number' => ['required','numeric',],
          'street' => ['required','max:100'],
          'post_code' => ['required','post_code'],
          'city' => ['required','max:100'],
        ];
    }
}
