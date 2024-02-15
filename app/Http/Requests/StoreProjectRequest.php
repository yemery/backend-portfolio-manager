<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|unique:projects|string|max:30',
            'sub_title' => 'required|unique:projects|string|max:50',
            'github' => 'required|unique:projects|url:http,https',
            'host_url' => 'nullable|unique:projects|url:http,https',
        ];
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
    return [
        'required' => 'The :attribute field is required.',
        'unique' => 'The :attribute must be unique.',
        'url' => 'The :attribute must be a valid HTTP or HTTPS URL.',
        'string' => 'The :attribute must be a string.',
        'max' => 'The :attribute must not be greater than :max characters.',


    ];
}
}
