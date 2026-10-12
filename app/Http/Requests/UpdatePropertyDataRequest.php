<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyDataRequest extends FormRequest
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
        return StorePropertyDataRequest::attributeRules();
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
