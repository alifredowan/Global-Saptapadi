<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class RegisterRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:male,female'],
            'date_of_birth' => ['required', 'date'],
            'role' => ['required', 'in:groom,bride,family_rep'],
            'profile_managed_by' => ['required', 'in:self,father,mother,brother,sister,uncle,aunt,grandparent,other'],
            'marital_status' => ['required', 'in:never_married,divorced,widowed,annulled'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'anti_bot_verified' => ['required', 'accepted'],
        ];
    }

    /**
     * Configure the validator instance with business logic & statutory law checks.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $dobInput = $this->input('date_of_birth');
            $gender = $this->input('gender');
            $maritalStatus = $this->input('marital_status');

            if ($dobInput && $gender) {
                try {
                    $dob = Carbon::parse($dobInput);
                    $age = $dob->age;

                    // Statutory Minimum Legal Age for Marriage (UN Convention on Consent to Marriage)
                    if ($gender === 'male' && $age < 21) {
                        $validator->errors()->add(
                            'date_of_birth',
                            "Underage registration barred: In accordance with statutory matrimonial standards and international conventions on the minimum age for marriage (UN Convention on Consent to Marriage), minimum age for male candidates is 21 years. Candidate is currently {$age} years old."
                        );
                    }

                    if ($gender === 'female' && $age < 18) {
                        $validator->errors()->add(
                            'date_of_birth',
                            "Underage registration barred: In accordance with statutory matrimonial standards and international conventions on the minimum age for marriage (UN Convention on Consent to Marriage), minimum age for female candidates is 18 years. Candidate is currently {$age} years old."
                        );
                    }
                } catch (\Exception $e) {
                    $validator->errors()->add('date_of_birth', 'Invalid date format provided.');
                }
            }

            // Strict Monogamy Mandate
            if ($maritalStatus === 'married') {
                $validator->errors()->add(
                    'marital_status',
                    'Strict Monogamy Mandate: Polygamy and bigamy are strictly prohibited under international family law and Dharmic matrimonial codes. Only unmarried (single), legally divorced, widowed, or annulled seekers may register.'
                );
            }
        });
    }
}

