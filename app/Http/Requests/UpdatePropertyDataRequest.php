<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = StorePropertyDataRequest::attributeRules();
        if ($this->user()->isAdmin()) {
            $rules['listing_user_id'] = [
                'nullable',
                'integer',
                Rule::exists('users', 'id')->where('role', 'realtor'),
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a property title.',
            'status.required' => 'Select a listing status.',
            'price.required' => 'Enter a price for this listing.',
            'currency.required' => 'Select a currency.',
            'property_type.required' => 'Select a property type.',
            'listing_user_id.exists' => 'Choose a valid realtor account for this listing.',
        ];
    }
}
