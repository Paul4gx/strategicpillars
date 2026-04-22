<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        $property = $this->route('property');
        if (! $property instanceof Property) {
            return false;
        }

        return $this->user()->can('update', $property);
    }

    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'Please choose an image file to upload.',
            'image.image' => 'The file must be a valid image.',
            'image.max' => 'Each image may be at most 10 MB.',
        ];
    }
}
