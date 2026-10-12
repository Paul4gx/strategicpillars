<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Property::class);
    }

    public static function attributeRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'status' => 'required|in:available,sold,rented,off-plan,upcoming',
            'price' => 'required|numeric',
            'currency' => 'required|in:NGN,USD',
            'property_type' => 'required|string|in:'.implode(',', array_keys(config('property_types.flat_list'))),
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'parking_spaces' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'estate_id' => 'nullable|exists:estates,id',
            'featured' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:255',
            'brochure' => 'nullable|file|mimes:pdf',
            'year_built' => 'nullable|integer|min:1900|max:2030',
            'area' => 'nullable|integer|min:1',
            'property_features' => 'nullable|array',
            'property_features.*' => 'string|max:255',
            'building_type' => 'nullable|in:office,home,complex,others',
        ];
    }

    public function rules(): array
    {
        return self::attributeRules();
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a property title.',
            'status.required' => 'Select a listing status.',
            'price.required' => 'Enter a price for this listing.',
            'currency.required' => 'Select a currency.',
            'property_type.required' => 'Select a property type.',
        ];
    }
}
