<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $emailRules = [
            'required', 'string', 'email', 'max:255',
            Rule::unique('team_members', 'email'),
        ];
        if ($this->boolean('create_property_account')) {
            $emailRules[] = Rule::unique('users', 'email');
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => $emailRules,
            'phone' => ['required', 'string', 'max:20'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp'],
            'sort_order' => ['nullable', 'integer'],
            'social_links' => ['nullable', 'array'],
            'social_links.*.platform' => ['nullable', 'string', 'max:50'],
            'social_links.*.username' => ['nullable', 'string', 'max:255'],
            'create_property_account' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already used by another team profile or login account.',
        ];
    }
}
