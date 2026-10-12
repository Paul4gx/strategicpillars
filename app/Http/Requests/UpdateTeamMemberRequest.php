<?php

namespace App\Http\Requests;

use App\Models\TeamMember;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->canManageTeam() ?? false;
    }

    public function rules(): array
    {
        /** @var TeamMember $team */
        $team = $this->route('team');

        $emailRules = [
            'required', 'string', 'email', 'max:255',
            Rule::unique('team_members', 'email')->ignore($team->id),
        ];
        if ($team->user_id) {
            $emailRules[] = Rule::unique('users', 'email')->ignore($team->user_id);
        } elseif ($this->boolean('create_property_account')) {
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
            'is_visible' => ['sometimes', 'boolean'],
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
