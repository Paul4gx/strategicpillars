@extends('admin.layouts.app')

@section('title', 'Add Property')
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
</style>
@endpush
@section('content')
 <div class="wg-box pl-44 mb-20">
<h3 style="margin-bottom:20px">Add New Property</h3>
<form id="property-form" 
      action="{{ route('admin.properties.store') }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="form-bacsic-infomation flex gap30 flex-column">
   @csrf
    <x-text-input2 title="Title" name="title" :value="old('title')" required />
    <x-text-input2 title="Short Description" name="short_description" :value="old('short_description')" required />
    <x-textarea2 title="Long Description" name="long_description" :value="old('long_description')" required />
    <fieldset class="text has-top-title">
        <select name="status" class="" name="text" tabindex="2" aria-required="true"  required>
            <option value="">Select Status</option>
            <option value="available">Available</option>
            <option value="sold">Sold</option>
            <option value="rented">Rented</option>
            <option value="off-plan">Off-plan</option>
            <option value="upcoming">Upcoming</option>
        </select>
        {{-- <label>Status</label> --}}
        @error('status')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <x-text-input2 title="Price" name="price" type="number" :value="old('price')" required />
    <x-text-input2 title="Discount Price (optional)" name="discount_price" type="number" :value="old('discount_price')" />
    <x-text-input2 title="Property Type" name="property_type" :value="old('property_type')" required />
    <div class="row mb-3">
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="Bedrooms" name="bedrooms" type="number" :value="old('bedrooms')" />
        </fieldset>
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="Bathrooms" name="bathrooms" type="number" :value="old('bathrooms')" />
        </fieldset>
        <fieldset class="col-md-4">
            <x-text-input2 title="Parking Spaces" name="parking_spaces" type="number" :value="old('parking_spaces')" />
        </fieldset>
    </div>
    <div class="row mb-3">
        <fieldset class="col-md-3 mb-15">
            <x-text-input2 title="Year Built" name="year_built" type="number" :value="old('year_built')" min="1900" max="2030" />
        </fieldset>
        <fieldset class="col-md-3 mb-15">
            <x-text-input2 title="Area (sq ft)" name="area" type="number" :value="old('area')" min="1" />
        </fieldset>
        <fieldset class="col-md-6">
            <select name="building_type" class="" tabindex="2" aria-required="true">
                <option value="">Select Building Type</option>
                <option value="office" @if(old('building_type') == 'office') selected @endif>Office</option>
                <option value="home" @if(old('building_type') == 'home') selected @endif>Home</option>
                <option value="complex" @if(old('building_type') == 'complex') selected @endif>Complex</option>
                <option value="others" @if(old('building_type') == 'others') selected @endif>Others</option>
            </select>
            {{-- <label>Building Type</label> --}}
            @error('building_type')<div class="text-danger">{{ $message }}</div>@enderror
        </fieldset>
    </div>
    <div class="row mb-3">
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="Address" name="address" :value="old('address')" />
        </fieldset>
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="City" name="city" :value="old('city')" />
        </fieldset>
        <fieldset class="col-md-4 mb-15">
            <x-text-input2 title="State" name="state" :value="old('state')" />
        </fieldset>
    </div>
    <fieldset class="text has-top-title">
        <select name="estate_id" class="" name="text" tabindex="2" aria-required="true" >
            <option value="">Choose Estate</option>
            @foreach($estates as $estate)
                <option value="{{ $estate->id }}" @if(old('estate_id') == $estate->id) selected @endif>{{ $estate->name }}</option>
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
                $oldFeatures = old('property_features', []);
            @endphp
            
        @foreach($amenities as $category => $features)
            <div class="amenity-category-collapsible">
                <h4 class="amenity-category-header" onclick="toggleAmenityCategory('{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $category) }}')">
                    {{ $category }}
                    <span class="toggle-icon" id="icon-{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $category) }}">▼</span>
                </h4>
                <div class="form-amenities collapsible-content" id="content-{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $category) }}" style="display: none;">
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
        @endforeach
        </div>
        @error('property_features')<div class="text-danger">{{ $message }}</div>@enderror
    {{-- <div style=""> --}}
        {{-- <input type="file" class="filepond" name="propertyImages[]" data-max-files="10" data-allow-reorder="true" data-max-file-size="3MB" multiple /> --}}
        {{-- <input type="file" class="" name="file[]" multiple /> --}}
    {{-- </div> --}}
    {{-- <fieldset class="text has-top-title">
        <label>Images (multiple)</label>
        <input type="file" name="images[]" class="" name="text" tabindex="2" aria-required="true"  multiple>
        @error('images')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset> --}}
    <fieldset class="text has-top-title">
        <label for="featuredbox" style="font-size: 1.5rem;cursor: pointer">Show on homepage: </label>
        <input type="checkbox" name="featured" id="featuredbox" value="1" @if(old('featured')) checked @endif> 
        {{-- <span class="text-xl"></span> --}}
    </fieldset>
    <x-text-input2 title="Video Link (YouTube/Vimeo)" name="video_link" :value="old('video_link')" />
    <fieldset class="text has-top-title">
        <label>Brochure (PDF)</label>
        <input type="file" name="brochure" class="" name="text" tabindex="2"  aria-required="true"  accept="application/pdf">
    </fieldset>
    <x-text-input2 title="SEO Title" name="seo_title" :value="old('seo_title')" />
    <x-text-input2 title="SEO Description" name="seo_description" :value="old('seo_description')" />
        {{-- Dropzone container (not a form itself) --}}
    <fieldset class="text has-top-title">
        <h5 class="mb-5">Add Property Images</h5>
        <div class="dropzone" id="property-dropzone"></div>
        @error('images')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <div class="form-group mb-3" style="text-align: right;">
        <button type="submit" class="tf-button-primary">Save Property</button>
    </div>
</form>
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

    let myDropzone = new Dropzone("#property-dropzone", {
        url: form.action,             // Laravel route
        autoProcessQueue: false,      // don’t upload immediately
        uploadMultiple: true,         // send all in one request
        parallelUploads: 10,
        maxFiles: 10,
        maxFilesize: 10,              // MB
        paramName: "images",          // Laravel will see `images[]`
        addRemoveLinks: true,
        dictRemoveFile: "Delete",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    });

    // When the form is submitted
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if (myDropzone.getQueuedFiles().length > 0) {
            myDropzone.processQueue();
        } else {
            form.submit(); // no images, just submit form
        }
    });

    // Append extra form data
    myDropzone.on("sendingmultiple", function (files, xhr, formData) {
        document.querySelectorAll("#property-form input, #property-form select, #property-form textarea")
            .forEach(function (el) {
                if (el.name) {
                    if (el.type === "checkbox") {
                        if (el.name === "property_features[]") {
                            if (el.checked) {
                                formData.append(el.name, el.value);
                            }
                        } else {
                            formData.append(el.name, el.checked ? el.value : "");
                        }
                    } else {
                        formData.append(el.name, el.value);
                    }
                }
            });
    });

    // On success, redirect or show message
    myDropzone.on("successmultiple", function (files, response) {
        window.location.href = "{{ route('admin.properties.index') }}";
    });

    myDropzone.on("errormultiple", function (files, response) {
        console.error(response);
        alert("Error uploading property");
    });
});
</script>
@endpush
