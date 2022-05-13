<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users', 'max:100'],
            'telegram' => ['required', 'string'],
            'referrer' => ['int', 'exists:users,id', 'nullable'],
            'balance' => ['string', 'nullable'],
            'password' => ['required', 'confirmed', 'min:6', 'max:100'],
        ];
    }
}
