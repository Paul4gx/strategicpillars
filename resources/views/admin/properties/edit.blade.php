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
    <x-text-input2 title="Price" name="price" type="number" :value="old('price', $property->price)" required />
    <x-text-input2 title="Discount Price (optional)" name="discount_price" type="number" :value="old('discount_price', $property->discount_price)" />
    <x-text-input2 title="Property Type" name="property_type" :value="old('property_type', $property->property_type)" required />
    <div class="row mb-3">
        <fieldset class="col-md-4">
            <x-text-input2 title="Bedrooms" name="bedrooms" type="number" :value="old('bedrooms', $property->bedrooms)" />
        </fieldset>
        <fieldset class="col-md-4">
            <x-text-input2 title="Bathrooms" name="bathrooms" type="number" :value="old('bathrooms', $property->bathrooms)" />
        </fieldset>
        <fieldset class="col-md-4">
            <x-text-input2 title="Parking Spaces" name="parking_spaces" type="number" :value="old('parking_spaces', $property->parking_spaces)" />
        </fieldset>
    </div>
    <div class="row mb-3">
        <fieldset class="col-md-3">
            <x-text-input2 title="Year Built" name="year_built" type="number" :value="old('year_built', $property->year_built)" min="1900" max="2030" />
        </fieldset>
        <fieldset class="col-md-3">
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
        <fieldset class="col-md-4">
            <x-text-input2 title="Address" name="address" :value="old('address', $property->address)" />
        </fieldset>
        <fieldset class="col-md-4">
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
    <div class="form-group">
        <label>Property Features & Amenities</label>
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
        <label>Featured</label>
        <input type="checkbox" name="featured" value="1" @if(old('featured', $property->featured)) checked @endif> Show on homepage
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
        <label>Add More Property Images</label>
        <div class="dropzone" id="property-dropzone"></div>
        @error('images')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <div class="form-group mb-3" style="text-align: right;">
        <button type="submit" class="tf-button-primary">Update Property</button>
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
    let isSubmitting = false;
    
    if (!form) {
        console.error("Form with ID 'property-form' not found!");
        return;
    }

    let myDropzone = new Dropzone("#property-dropzone", {
        url: form.action,             // Laravel route
        method: "POST",               // Use POST for file uploads
        autoProcessQueue: false,      // don't upload immediately
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

        if (isSubmitting) {
            return; // Prevent multiple submissions
        }
        
        if (myDropzone.getQueuedFiles().length > 0) {
            isSubmitting = true;
            myDropzone.processQueue();
        } else {
            // Submit form normally
            isSubmitting = true;
            form.submit();
        }
    });

    // Append extra form data
    myDropzone.on("sendingmultiple", function (files, xhr, formData) {
        // Add the _method field for PUT request
        formData.append("_method", "PUT");
        
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
        isSubmitting = false;
        window.location.href = "{{ route('admin.properties.index') }}";
    });

    myDropzone.on("errormultiple", function (files, response) {
        isSubmitting = false;
        console.error(response);
        alert("Error uploading property");
    });

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