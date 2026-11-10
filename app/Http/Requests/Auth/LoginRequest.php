<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Enforces strict validation according to OWASP A03/A07.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom user-friendly validation error messages.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter your registered email address.',
            'email.email' => 'Please provide a valid email format.',
            'password.required' => 'Please enter your password.',
        ];
    }
}

