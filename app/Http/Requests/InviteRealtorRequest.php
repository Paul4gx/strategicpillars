<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InviteRealtorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->canManageTeam();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique('users', 'email'),
                Rule::unique('team_members', 'email'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already used by a team profile or login account.',
        ];
    }
}
