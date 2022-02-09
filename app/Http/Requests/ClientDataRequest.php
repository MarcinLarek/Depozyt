<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClientDataRequest extends FormRequest
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
            'surname' => ['required'],
            'name' => ['required'],
            'pesel' => ['required'],
            'document_type' => ['required'],
            'document_number' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'city' => ['required'],
            'post_code' => ['required'],
            'street' => ['required'],
        ];
    }
}
