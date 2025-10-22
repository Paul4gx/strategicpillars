@extends('admin.layouts.app')

@section('title', 'Edit Property')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<style>
.amenity-category-collapsible {
    margin-bottom: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
}

.amenity-category-header {
    background: #f8f9fa;
    padding: 12px 15px;
    margin: 0;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 16px;
    font-weight: 600;
    color: #333;
    border-bottom: 1px solid #e0e0e0;
    transition: background-color 0.3s ease;
}

.amenity-category-header:hover {
    background: #e9ecef;
}

.toggle-icon {
    font-size: 12px;
    transition: transform 0.3s ease;
    color: #666;
}

.toggle-icon.rotated {
    transform: rotate(180deg);
}

.collapsible-content {
    padding: 15px;
    background: #fff;
    max-height: 300px;
    overflow-y: auto;
}

.form-amenities .grid-checkbox {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.checkbox-item {
    margin: 0;
}

.checkbox-item label {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fff;
}

.checkbox-item label:hover {
    background: #f8f9fa;
    border-color: #007bff;
}

.checkbox-item input[type="checkbox"] {
    display: none;
}

.checkbox-item p {
    margin: 0;
    margin-left: 25px;
    flex: 1;
    font-size: 14px;
    color: #333;
}

.btn-checkbox {
    width: 20px;
    height: 20px;
    border: 2px solid #ddd;
    border-radius: 4px;
    margin-left: 10px;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-item input[type="checkbox"]:checked + .btn-checkbox {
    background: #007bff;
    border-color: #007bff;
}

.checkbox-item input[type="checkbox"]:checked + .btn-checkbox::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
}

/* ========================================
   PROGRESS MODAL STYLES - ENHANCED & RESPONSIVE
   ======================================== */

/* Modal Overlay & Container */
#progressModal {
    z-index: 9999 !important;
}

#progressModal .modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
}

#progressModal .modal-content {
    border: none !important;
    border-radius: 16px !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3) !important;
    overflow: hidden;
    background: #ffffff;
}

/* Modal Header */
#progressModal .modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: #ffffff !important;
    border: none !important;
    padding: 1.5rem 2rem !important;
    position: relative;
}

#progressModal .modal-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    z-index: -1;
}

#progressModal .modal-title {
    font-weight: 700 !important;
    font-size: 1.25rem !important;
    margin: 0 !important;
    text-align: center;
    width: 100%;
}

/* Modal Body */
#progressModal .modal-body {
    padding: 2rem !important;
    background: #ffffff;
}

/* Progress Steps Container */
.progress-steps-container {
    margin-bottom: 2rem;
}

/* Overall Progress Section */
.overall-progress-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

/* Progress Container */
.progress-container {
    margin-top: 0.5rem;
}

/* Progress Steps */
.progress-step {
    margin-bottom: 1.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 1;
}

.progress-step:last-child {
    margin-bottom: 0;
}

.progress-step.completed {
    opacity: 0.8;
}

.progress-step.active {
    opacity: 1;
    transform: scale(1.02);
}

.progress-step.error {
    opacity: 0.9;
}

/* Step Icon */
.step-icon {
    width: 32px !important;
    height: 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    background: #f8f9fa !important;
    border: 3px solid #e9ecef !important;
    transition: all 0.3s ease !important;
    flex-shrink: 0;
}

.step-icon i {
    color: #28a745 !important;
    font-size: 14px !important;
    font-weight: bold;
}

.step-icon .spinner-border-sm {
    width: 16px !important;
    height: 16px !important;
    border-width: 2px !important;
    border-color: #007bff !important;
    border-right-color: transparent !important;
}

/* Step States */
.progress-step.completed .step-icon {
    background: #d4edda !important;
    border-color: #28a745 !important;
    transform: scale(1.1);
}

.progress-step.active .step-icon {
    background: #cce7ff !important;
    border-color: #007bff !important;
    animation: pulse 2s infinite;
}

.progress-step.error .step-icon {
    background: #f8d7da !important;
    border-color: #dc3545 !important;
}

.progress-step.error .step-icon i {
    color: #dc3545 !important;
}

/* Step Content */
.progress-step h6 {
    font-weight: 600 !important;
    font-size: 1rem !important;
    margin: 0 0 0.25rem 0 !important;
    color: #212529 !important;
}

.progress-step p {
    font-size: 0.875rem !important;
    margin: 0 !important;
    color: #6c757d !important;
    line-height: 1.4;
}

/* Progress Bars */
#image-progress-bar {
    height: 8px !important;
    border-radius: 4px !important;
    background: linear-gradient(45deg, #007bff, #0056b3) !important;
    transition: width 0.3s ease !important;
}

#overall-progress-bar {
    height: 10px !important;
    border-radius: 5px !important;
    background: linear-gradient(45deg, #28a745, #20c997) !important;
    transition: width 0.3s ease !important;
}

.progress {
    background-color: #e9ecef !important;
    border-radius: 5px !important;
    overflow: hidden;
}

/* Progress Text */
#image-progress-text,
#overall-progress-text {
    font-size: 0.875rem !important;
    font-weight: 500 !important;
}

/* Modal Footer */
#progressModal .modal-footer {
    background: #f8f9fa !important;
    border: none !important;
    padding: 1.5rem 2rem !important;
    justify-content: center !important;
}

#progressModal .btn-success {
    background: linear-gradient(45deg, #28a745, #20c997) !important;
    border: none !important;
    border-radius: 8px !important;
    padding: 0.75rem 2rem !important;
    font-weight: 600 !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3) !important;
}

#progressModal .btn-success:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4) !important;
}

/* Error Alert */
#error-alert {
    position: fixed !important;
    top: 20px !important;
    right: 20px !important;
    z-index: 10000 !important;
    min-width: 300px !important;
    max-width: 400px !important;
    box-shadow: 0 8px 32px rgba(220, 53, 69, 0.3) !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 1rem 1.25rem !important;
}

#error-alert .btn-close {
    padding: 0.5rem !important;
    margin: -0.5rem -0.5rem -0.5rem auto !important;
}

/* Button States */
#submit-btn:disabled {
    opacity: 0.6 !important;
    cursor: not-allowed !important;
    transform: none !important;
}

#submit-btn.loading {
    position: relative !important;
    color: transparent !important;
    pointer-events: none !important;
}

#submit-btn.loading::after {
    content: "" !important;
    position: absolute !important;
    width: 20px !important;
    height: 20px !important;
    top: 50% !important;
    left: 50% !important;
    margin-left: -10px !important;
    margin-top: -10px !important;
    border: 3px solid #ffffff !important;
    border-radius: 50% !important;
    border-top-color: transparent !important;
    animation: spin 1s linear infinite !important;
}

/* Form Validation */
.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.is-valid {
    border-color: #28a745 !important;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
}

/* Animations */
@keyframes spin {
    to { transform: rotate(360deg); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes progress-bar-stripes {
    0% { background-position: 1rem 0; }
    100% { background-position: 0 0; }
}

.progress-bar-animated {
    animation: progress-bar-stripes 1s linear infinite !important;
}

/* ========================================
   RESPONSIVE DESIGN
   ======================================== */

/* Mobile Devices */
@media (max-width: 576px) {
    #progressModal .modal-dialog {
        margin: 1rem !important;
        max-width: calc(100% - 2rem) !important;
    }
    
    #progressModal .modal-header {
        padding: 1rem 1.5rem !important;
    }
    
    #progressModal .modal-body {
        padding: 1.5rem !important;
    }
    
    #progressModal .modal-footer {
        padding: 1rem 1.5rem !important;
    }
    
    .progress-step {
        margin-bottom: 1rem !important;
    }
    
    .step-icon {
        width: 28px !important;
        height: 28px !important;
    }
    
    .step-icon i {
        font-size: 12px !important;
    }
    
    .progress-step h6 {
        font-size: 0.9rem !important;
    }
    
    .progress-step p {
        font-size: 0.8rem !important;
    }
    
    #error-alert {
        top: 10px !important;
        right: 10px !important;
        left: 10px !important;
        min-width: auto !important;
        max-width: none !important;
    }
}

/* Tablet Devices */
@media (min-width: 577px) and (max-width: 768px) {
    #progressModal .modal-dialog {
        max-width: 450px !important;
    }
}

/* Large Screens */
@media (min-width: 1200px) {
    #progressModal .modal-dialog {
        max-width: 550px !important;
    }
    
    #progressModal .modal-body {
        padding: 2.5rem !important;
    }
}

/* ========================================
   ACCESSIBILITY & UX ENHANCEMENTS
   ======================================== */

/* Focus States */
#progressModal .btn:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    #progressModal .modal-content {
        border: 2px solid #000000 !important;
    }
    
    .step-icon {
        border-width: 2px !important;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .progress-step,
    .step-icon,
    #submit-btn.loading::after {
        animation: none !important;
        transition: none !important;
    }
}

/* Print Styles */
@media print {
    #progressModal {
        display: none !important;
    }
}
</style>
@endpush
@section('content')
 <div class="wg-box pl-44 mb-20">
<h3>Edit Property</h3>
<form id="property-form" 
      action="{{ route('admin.properties.update', $property) }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="form-bacsic-infomation flex gap30 flex-column">
   @csrf
   @method('PUT')
    <x-text-input2 title="Title" name="title" :value="old('title', $property->title)" required />
    <x-text-input2 title="Short Description" name="short_description" :value="old('short_description', $property->short_description)" />
    <x-textarea2 title="Long Description" name="long_description" :value="old('long_description', $property->long_description)" />
    <fieldset class="text has-top-title">
        
        <select name="status" class="" name="text" tabindex="2" aria-required="true"  required>
            <option value="">Select Status</option>
            <option value="available" @if(old('status', $property->status) == 'available') selected @endif>Available</option>
            <option value="sold" @if(old('status', $property->status) == 'sold') selected @endif>Sold</option>
            <option value="rented" @if(old('status', $property->status) == 'rented') selected @endif>Rented</option>
            <option value="off-plan" @if(old('status', $property->status) == 'off-plan') selected @endif>Off-plan</option>
            <option value="upcoming" @if(old('status', $property->status) == 'upcoming') selected @endif>Upcoming</option>
        </select>
        {{-- <label>Status</label> --}}
        @error('status')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <div class="row mb-3">
        <fieldset class="col-md-8 mb-15">
            <x-text-input2 title="Price" name="price" type="number" :value="old('price', $property->price)" required />
        </fieldset>
        <fieldset class="col-md-4 mb-15">
            <select name="currency" class="form-select nice-select" required>
                <option value="NGN" {{ old('currency', $property->currency ?? 'NGN') == 'NGN' ? 'selected' : '' }}>₦ Naira (NGN)</option>
                <option value="USD" {{ old('currency', $property->currency) == 'USD' ? 'selected' : '' }}>$ Dollar (USD)</option>
            </select>
            <label>Currency</label>
            @error('currency')<div class="text-danger">{{ $message }}</div>@enderror
        </fieldset>
    </div>
    <x-text-input2 title="Discount Price (optional)" name="discount_price" type="number" :value="old('discount_price', $property->discount_price)" />
    
    <fieldset class="mb-15">
        <select name="property_type" class="form-select nice-select" required>
            <option value="">Select Property Type</option>
            @php
                $groupedTypes = \App\Models\Property::getGroupedPropertyTypes();
                $currentType = old('property_type', $property->property_type);
            @endphp
            @foreach($groupedTypes as $categoryKey => $category)
                <optgroup label="{{ $category['label'] }}">
                    @foreach($category['options'] as $typeKey => $typeLabel)
                        <option value="{{ $typeKey }}" {{ $currentType == $typeKey ? 'selected' : '' }}>
                            {{ $typeLabel }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
        <label>Property Type</label>
        @error('property_type')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <div class="row mb-3">
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="Bedrooms" name="bedrooms" type="number" :value="old('bedrooms', $property->bedrooms)" />
        </fieldset>
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="Bathrooms" name="bathrooms" type="number" :value="old('bathrooms', $property->bathrooms)" />
        </fieldset>
        <fieldset class="col-md-4">
            <x-text-input2 title="Parking Spaces" name="parking_spaces" type="number" :value="old('parking_spaces', $property->parking_spaces)" />
        </fieldset>
    </div>
    <div class="row mb-3">
        <fieldset class="col-md-3 mb-15">
            <x-text-input2 title="Year Built" name="year_built" type="number" :value="old('year_built', $property->year_built)" min="1900" max="2030" />
        </fieldset>
        <fieldset class="col-md-3 mb-15">
            <x-text-input2 title="Area (sq ft)" name="area" type="number" :value="old('area', $property->area)" min="1" />
        </fieldset>
        <fieldset class="col-md-6">
            <select name="building_type" class="" tabindex="2" aria-required="true">
                <option value="">Select Building Type</option>
                <option value="office" @if(old('building_type', $property->building_type) == 'office') selected @endif>Office</option>
                <option value="home" @if(old('building_type', $property->building_type) == 'home') selected @endif>Home</option>
                <option value="complex" @if(old('building_type', $property->building_type) == 'complex') selected @endif>Complex</option>
                <option value="others" @if(old('building_type', $property->building_type) == 'others') selected @endif>Others</option>
            </select>
            @error('building_type')<div class="text-danger">{{ $message }}</div>@enderror
        </fieldset>
    </div>
    <div class="row mb-3">
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="Address" name="address" :value="old('address', $property->address)" />
        </fieldset>
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="City" name="city" :value="old('city', $property->city)" />
        </fieldset>
        <fieldset class="col-md-4">
            <x-text-input2 title="State" name="state" :value="old('state', $property->state)" />
        </fieldset>
    </div>
    <fieldset class="text has-top-title">
       
        <select name="estate_id" class="" name="text" tabindex="2" aria-required="true" >
            <option value="">Choose Estate</option>
            @foreach($estates as $estate)
                <option value="{{ $estate->id }}" @if(old('estate_id', $property->estate_id) == $estate->id) selected @endif>{{ $estate->name }}</option>
            @endforeach
        </select>
        
    </fieldset>
    
    {{-- Property Features/Amenities Section --}}
    <div class="form-group w-100">
        <h5 class="mb-5">Property Features & Amenities</h5>
        @php
            $amenities = [
                "Climate & Comfort" => [
                    "Air Conditioning",
                    "Heating",
                    "Ceiling Fans",
                    "Ventilation System",
                    "Humidifier / Dehumidifier",
                    "Insulation / Energy-efficient Windows",
                ],
                "Interior Features" => [
                    "Window Coverings",
                    "Flooring",
                    "Built-in Wardrobes",
                    "Walk-in Closet",
                    "Fireplace",
                    "Skylights",
                    "Smart Home Controls",
                    "Soundproof Walls",
                ],
                "Kitchen & Dining" => [
                    "Refrigerator / Freezer",
                    "Microwave",
                    "Oven",
                    "Stove / Cooktop",
                    "Dishwasher",
                    "Wine Cooler",
                    "Pantry",
                    "Breakfast Bar / Island",
                    "Garbage Disposal",
                ],
                "Bathrooms & Wellness" => [
                    "Bathtub",
                    "Sauna",
                    "Steam Room",
                    "Shower Cabin",
                    "Double Sink Vanity",
                    "Heated Towel Racks",
                ],
                "Laundry & Utilities" => [
                    "Washer",
                    "Dryer",
                    "Laundry Room",
                    "Ironing Facilities",
                    "Clothesline / Drying Rack",
                    "Water Heater",
                    "Backup Generator",
                    "Solar Panels",
                ],
                "Technology & Connectivity" => [
                    "WiFi / Broadband Internet",
                    "TV Cable / Satellite TV",
                    "Home Theater",
                    "Intercom System",
                    "Smart Door Locks / Video Doorbell",
                    "EV Charging Station",
                ],
                "Lifestyle & Recreation" => [
                    "Swimming Pool",
                    "Jacuzzi / Hot Tub",
                    "Gym / Fitness Center",
                    "Barbeque / Outdoor Grill",
                    "Game Room",
                    "Cinema Room",
                    "Library / Study Room",
                    "Wine Cellar",
                    "Kids' Play Area",
                ],
                "Outdoor & Landscaping" => [
                    "Lawn / Garden",
                    "Patio / Deck",
                    "Balcony / Terrace",
                    "Rooftop Access",
                    "Outdoor Kitchen",
                    "Fire Pit",
                    "Pergola / Gazebo",
                    "Fencing / Privacy Screens",
                    "Sprinkler / Irrigation System",
                ],
                "Parking & Access" => [
                    "Garage",
                    "Carport",
                    "Driveway",
                    "Visitor Parking",
                    "Gated Entry",
                    "Handicap Accessibility",
                ],
                "Office & Commercial Features" => [
                    "Conference / Meeting Rooms",
                    "Reception Area",
                    "Break Room / Kitchenette",
                    "Co-working Spaces",
                    "Printing / Copy Room",
                    "Security Desk / Concierge",
                    "Elevator Access",
                    "Commercial HVAC System",
                ],
                "Safety & Security" => [
                    "Smoke Detectors",
                    "Fire Sprinkler System",
                    "Fire Extinguishers",
                    "Security Cameras",
                    "Burglar Alarm",
                    "24hr Security / Gated Community",
                    "Safe Room / Panic Room",
                ],
                "Building & Structural" => [
                    "Basement",
                    "Attic",
                    "Storage Room",
                    "Workshop / Tool Shed",
                    "High Ceilings",
                    "Open Floor Plan",
                    "Soundproof Windows",
                    "Energy-efficient Design",
                ],
            ];
            $oldFeatures = old('property_features', $property->property_features ?? []);
        @endphp
        
        @foreach($amenities as $category => $features)
            <div class="amenity-category-collapsible">
                <h4 class="amenity-category-header" onclick="toggleAmenityCategory('{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $category) }}')">
                    {{ $category }}
                    <span class="toggle-icon" id="icon-{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $category) }}">▼</span>
                </h4>
                <div class="collapsible-content" id="content-{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $category) }}" style="display: none;">
                    <div class="form-amenities">
                    <ul class="grid-checkbox">
                        @foreach($features as $feature)
                        <li class="checkbox-item">
                            <label>
                                <p>{{ $feature }}</p>
                                <input type="checkbox" 
                                           name="property_features[]" 
                                           value="{{ $feature }}" 
                                           id="feature_{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $feature) }}"
                                           @if(in_array($feature, $oldFeatures)) checked @endif>
                                <span class="btn-checkbox"></span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @error('property_features')<div class="text-danger">{{ $message }}</div>@enderror
    
    <fieldset class="text has-top-title">
        <label for="featuredbox" style="font-size: 1.5rem;cursor: pointer">Show on homepage: </label>
        <input type="checkbox" name="featured" id="featuredbox" value="1" @if(old('featured', $property->featured)) checked @endif> 
    </fieldset>
    <x-text-input2 title="Video Link (YouTube/Vimeo)" name="video_link" :value="old('video_link', $property->video_link)" />
    <div class="form-group mb-3">
        <label>Current Brochure</label>
        @if($property->brochure)
            <a href="{{ asset('uploads/brochures/' . $property->brochure) }}" target="_blank">Download Brochure</a>
        @else
            <span>No brochure uploaded.</span>
        @endif
    </div>
    <fieldset class="text has-top-title">
        <label>Replace Brochure (PDF)</label>
        <input type="file" name="brochure" class="" name="text" tabindex="2"  aria-required="true"  accept="application/pdf">
    </fieldset>
    <x-text-input2 title="SEO Title" name="seo_title" :value="old('seo_title', $property->seo_title)" />
    <x-text-input2 title="SEO Description" name="seo_description" :value="old('seo_description', $property->seo_description)" />
        <div class="form-group mb-3">
         <div class="upload-image-wrap">
                <div class="text">Current Image</div>
                                    <div class="list">
                                        @foreach($property->images as $image)
                                        <div class="item">
                                            <img src="{{ asset('storage/uploads/properties/' . $image->image_path) }}" alt="">
                                            <ul class="">
                                                <li class="delete-btns btn btn-sm btn-danger mt-1 delete-image-btn" role="button" data-image-id="{{ $image->id }}">
                                                    <i class="flaticon-delete" style="color:red"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                    <p>Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg &amp; .png</p>
                                </div>
    </div>
        {{-- Dropzone container (not a form itself) --}}
    <fieldset class="text has-top-title">
        <h5 class="mb-5">Add Property Images</h5>
        <div class="dropzone" id="property-dropzone"></div>
        @error('images')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <div class="form-group mb-3" style="text-align: right;">
        <button type="submit" class="tf-button-primary" id="submit-btn">Update Property</button>
    </div>
</form>

<!-- Progress Bar Modal -->
<div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="progressModalLabel">Updating Property</h5>
            </div>
            <div class="modal-body">
                <!-- Progress Steps Container -->
                <div class="progress-steps-container">
                    <!-- Step 1: Updating Property Data -->
                    <div class="progress-step active" id="step1" role="status" aria-live="polite">
                        <div class="d-flex align-items-center">
                            <div class="step-icon me-3" aria-hidden="true">
                                <i class="flaticon-check" id="step1-icon" style="display: none;" aria-hidden="true"></i>
                                <div class="spinner-border spinner-border-sm" id="step1-spinner" role="status" aria-hidden="true">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Updating Property Data</h6>
                                <p class="text-muted mb-0" id="step1-text">Validating and updating property information...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Uploading New Images -->
                    <div class="progress-step" id="step2" style="display: none;" role="status" aria-live="polite">
                        <div class="d-flex align-items-center mb-3">
                            <div class="step-icon me-3" aria-hidden="true">
                                <i class="flaticon-check" id="step2-icon" style="display: none;" aria-hidden="true"></i>
                                <div class="spinner-border spinner-border-sm" id="step2-spinner" role="status" aria-hidden="true">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Uploading New Images</h6>
                                <p class="text-muted mb-0" id="step2-text">Processing new images...</p>
                            </div>
                        </div>
                        
                        <!-- Image Upload Progress -->
                        <div class="progress-container">
                            <div class="progress mb-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                     id="image-progress-bar" 
                                     style="width: 0%">
                                </div>
                            </div>
                            <small class="text-muted" id="image-progress-text">0 of 0 images uploaded</small>
                        </div>
                    </div>
                </div>

                <!-- Overall Progress Section -->
                <div class="overall-progress-section">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Overall Progress</span>
                        <span class="fw-bold text-primary" id="overall-progress-text">0%</span>
                    </div>
                    <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" 
                             id="overall-progress-bar" 
                             style="width: 0%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="progress-footer" style="display: none;">
                <button type="button" class="btn btn-success btn-lg" onclick="window.location.href='{{ route('admin.properties.index') }}'">
                    <i class="flaticon-check me-2"></i>View Properties
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Error Alert -->
<div class="alert alert-danger alert-dismissible fade" id="error-alert" role="alert" style="display: none;">
    <i class="flaticon-warning me-2"></i>
    <span id="error-message"></span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

 </div>
@endsection 

@push('scripts')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
// Collapsible amenities function
function toggleAmenityCategory(categoryId) {
    const content = document.getElementById('content-' + categoryId);
    const icon = document.getElementById('icon-' + categoryId);
    
    if (content.style.display === 'none') {
        content.style.display = 'block';
        icon.classList.add('rotated');
    } else {
        content.style.display = 'none';
        icon.classList.remove('rotated');
    }
}

// Initialize - open first category by default
document.addEventListener("DOMContentLoaded", function () {
    const firstCategory = document.querySelector('.amenity-category-collapsible');
    if (firstCategory) {
        const firstContent = firstCategory.querySelector('.collapsible-content');
        const firstIcon = firstCategory.querySelector('.toggle-icon');
        if (firstContent && firstIcon) {
            firstContent.style.display = 'block';
            firstIcon.classList.add('rotated');
        }
    }
});

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector("#property-form");
    let submitBtn = document.querySelector("#submit-btn");
    let isSubmitting = false;
    let propertyId = {{ $property->id }};
    let uploadedImages = 0;
    let totalImages = 0;
    const baseUrl = "{{ url('/') }}";
    
    if (!form) {
        console.error("Form with ID 'property-form' not found!");
        return;
    }

    // Initialize Dropzone for image preview only
    let myDropzone = new Dropzone("#property-dropzone", {
        url: "#", // Will be set dynamically
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 1,
        maxFiles: 10,
        maxFilesize: 10, // 10MB max - matches existing system
        paramName: "image",
        addRemoveLinks: true,
        dictRemoveFile: "Remove",
        acceptedFiles: "image/*",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    });

    // Form submission handler
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        
        if (isSubmitting) return;
        
        // Validate form
        if (!validateForm()) {
            return;
        }

        startTwoStepProcess();
    });

    // Real-time validation
    form.addEventListener("input", function (e) {
        if (e.target.hasAttribute('required')) {
            if (e.target.value.trim()) {
                e.target.classList.remove('is-invalid');
                e.target.classList.add('is-valid');
            } else {
                e.target.classList.remove('is-valid');
                e.target.classList.add('is-invalid');
            }
        }
    });

    // Form validation
    function validateForm() {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        let errorFields = [];
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
                errorFields.push(field.getAttribute('name') || field.getAttribute('title') || 'field');
            } else {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
            }
        });

        // Additional validation for specific fields
        const priceField = form.querySelector('input[name="price"]');
        if (priceField && priceField.value && isNaN(parseFloat(priceField.value))) {
            priceField.classList.add('is-invalid');
            isValid = false;
            errorFields.push('price');
        }

        if (!isValid) {
            const fieldNames = errorFields.join(', ');
            showError(`Please fill in all required fields: ${fieldNames}`);
        }

        return isValid;
    }

    // Start the two-step process
    function startTwoStepProcess() {
        isSubmitting = true;
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        
        // Show progress modal
        const progressModal = new bootstrap.Modal(document.getElementById('progressModal'));
        progressModal.show();
        
        // Start Step 1: Update property data
        updatePropertyData();
    }

    // Step 1: Update property data via AJAX
    function updatePropertyData() {
        updateStep1Status('Updating property data...', 'loading');
        
        const formData = new FormData(form);
        formData.append('_method', 'PUT');
        
        fetch(`${baseUrl}/admin/properties/update-data/${propertyId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateStep1Status('Property data updated successfully!', 'success');
                
                // Move to Step 2: Upload new images
                setTimeout(() => {
                    startImageUpload();
                }, 1000);
            } else {
                throw new Error(data.message || 'Failed to update property data');
            }
        })
        .catch(error => {
            console.error('Error updating property data:', error);
            updateStep1Status('Failed to update property data', 'error');
            showError('Failed to update property data: ' + error.message);
            resetForm();
        });
    }

    // Step 2: Upload new images sequentially
    function startImageUpload() {
        const files = myDropzone.getQueuedFiles();
        totalImages = files.length;
        uploadedImages = 0;

        if (totalImages === 0) {
            // No new images to upload, complete the process
            completeProcess();
            return;
        }

        // Show Step 2
        document.getElementById('step2').style.display = 'block';
        updateStep2Status('Starting image upload...', 'loading');
        updateImageProgress(0, totalImages);

        // Upload images one by one
        uploadImagesSequentially(files, 0);
    }

    function uploadImagesSequentially(files, index) {
        if (index >= files.length) {
            // All images uploaded
            updateStep2Status('All images uploaded successfully!', 'success');
            setTimeout(() => {
                completeProcess();
            }, 1000);
            return;
        }

        const file = files[index];
        updateStep2Status(`Uploading image ${index + 1} of ${totalImages}...`, 'loading');

        // Create FormData for single image
        const formData = new FormData();
        formData.append('image', file);

        fetch(`${baseUrl}/admin/properties/store-images/${propertyId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                uploadedImages++;
                updateImageProgress(uploadedImages, totalImages);
                
                // Continue with next image
                setTimeout(() => {
                    uploadImagesSequentially(files, index + 1);
                }, 500); // Small delay between uploads
            } else {
                throw new Error(data.message || 'Failed to upload image');
            }
        })
        .catch(error => {
            console.error('Error uploading image:', error);
            updateStep2Status(`Failed to upload image ${index + 1}`, 'error');
            
            // Continue with next image even if one fails
            setTimeout(() => {
                uploadImagesSequentially(files, index + 1);
            }, 500);
        });
    }

    // Complete the process
    function completeProcess() {
        updateOverallProgress(100);
        document.getElementById('progress-footer').style.display = 'block';
        document.getElementById('progressModalLabel').textContent = 'Property Updated Successfully!';
    }

    // Update Step 1 status
    function updateStep1Status(text, status) {
        document.getElementById('step1-text').textContent = text;
        
        if (status === 'success') {
            document.getElementById('step1-spinner').style.display = 'none';
            document.getElementById('step1-icon').style.display = 'inline';
            document.getElementById('step1').classList.add('completed');
        } else if (status === 'error') {
            document.getElementById('step1-spinner').style.display = 'none';
        }
    }

    // Update Step 2 status
    function updateStep2Status(text, status) {
        document.getElementById('step2-text').textContent = text;
        
        if (status === 'success') {
            document.getElementById('step2-spinner').style.display = 'none';
            document.getElementById('step2-icon').style.display = 'inline';
            document.getElementById('step2').classList.add('completed');
        } else if (status === 'error') {
            document.getElementById('step2-spinner').style.display = 'none';
        }
    }

    // Update image progress
    function updateImageProgress(current, total) {
        const percentage = Math.round((current / total) * 100);
        const progressBar = document.getElementById('image-progress-bar');
        const progressContainer = progressBar.closest('.progress');
        
        progressBar.style.width = percentage + '%';
        progressBar.setAttribute('aria-valuenow', percentage);
        progressContainer.setAttribute('aria-valuenow', percentage);
        
        document.getElementById('image-progress-text').textContent = `${current} of ${total} images uploaded`;
        updateOverallProgress(50 + (percentage * 0.5)); // Step 2 is 50% of total progress
    }

    // Update overall progress
    function updateOverallProgress(percentage) {
        const progressBar = document.getElementById('overall-progress-bar');
        const progressContainer = progressBar.closest('.progress');
        
        progressBar.style.width = percentage + '%';
        progressBar.setAttribute('aria-valuenow', percentage);
        progressContainer.setAttribute('aria-valuenow', percentage);
        
        document.getElementById('overall-progress-text').textContent = percentage + '%';
    }

    // Show error message
    function showError(message) {
        document.getElementById('error-message').textContent = message;
        document.getElementById('error-alert').classList.add('show');
        document.getElementById('error-alert').style.display = 'block';
    }

    // Reset form state
    function resetForm() {
        isSubmitting = false;
        submitBtn.disabled = false;
        submitBtn.classList.remove('loading');
        
        // Hide progress modal
        const progressModal = bootstrap.Modal.getInstance(document.getElementById('progressModal'));
        if (progressModal) {
            progressModal.hide();
        }
    }

    // Handle delete image buttons
    document.querySelectorAll('.delete-image-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageId = this.getAttribute('data-image-id');
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.properties.deleteImage", ":id") }}'.replace(':id', imageId);
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endpush 