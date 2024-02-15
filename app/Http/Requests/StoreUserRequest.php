<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'password' => ['required'],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'email:rfc,dns' => 'The :attribute must be a valid email address.',
            'unique' => 'The :attribute must be unique.'
        ];
    }
}
