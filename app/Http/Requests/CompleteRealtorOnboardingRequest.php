<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteRealtorOnboardingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isRealtor();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'realty_display_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:32'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'avatar' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'realty_display_name.required' => 'Enter your realty or brand name as it should appear to clients.',
            'phone.required' => 'Add a contact phone number for your listings.',
            'avatar.image' => 'Please upload a valid image file (JPG, PNG, GIF, or WebP).',
            'avatar.mimes' => 'Photo must be a JPG, PNG, GIF, or WebP image.',
            'avatar.max' => 'Photo may not be larger than 10 MB.',
        ];
    }
}
