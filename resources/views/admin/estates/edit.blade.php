@extends('admin.layouts.app')

@section('title', 'Edit Estate')
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
<h3>Edit Estate</h3>
<form id="estate-form" 
      action="{{ route('admin.estates.update', $estate) }}" 
      method="POST" 
      enctype="multipart/form-data" 
      class="form-bacsic-infomation flex gap30 flex-column">
   @csrf
   @method('PUT')
    <x-text-input2 title="Estate Name" name="name" :value="old('name', $estate->name)" required />
    <x-textarea2 title="Description" name="description" :value="old('description', $estate->description)" />
    <div class="row mb-3">
        <fieldset class="col-md-6">
            <x-text-input2 title="City" name="city" :value="old('city', $estate->city)" />
        </fieldset>
        <fieldset class="col-md-6">
            <x-text-input2 title="State" name="state" :value="old('state', $estate->state)" />
        </fieldset>
    </div>
    <fieldset class="text has-top-title">
        <select name="status" class="" tabindex="2" aria-required="true" required>
            <option value="">Select Status</option>
            <option value="completed" @if(old('status', $estate->status) == 'completed') selected @endif>Completed</option>
            <option value="developing" @if(old('status', $estate->status) == 'developing') selected @endif>Developing</option>
            <option value="upcoming" @if(old('status', $estate->status) == 'upcoming') selected @endif>Upcoming</option>
        </select>
        <label>Status</label>
        @error('status')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    <x-textarea2 title="Google Map Embed (iframe)" name="map_embed" :value="old('map_embed', $estate->map_embed)" />
    
    {{-- Estate Amenities Section --}}
    <div class="form-group">
        <label>Estate Amenities</label>
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
            $oldAmenities = old('amenities', $estate->amenities ?? []);
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
                                               name="amenities[]" 
                                               value="{{ $feature }}" 
                                               id="amenity_{{ str_replace([' ', '/', '&'], ['_', '_', 'and'], $feature) }}"
                                               @if(in_array($feature, $oldAmenities)) checked @endif>
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
    @error('amenities')<div class="text-danger">{{ $message }}</div>@enderror
    
    <div class="form-group mb-3">
        <label>Current Cover Image</label>
        @if($estate->cover_image)
            <img src="{{ asset('storage/uploads/estates/covers/'.$estate->cover_image) }}" alt="Cover" class="img-fluid mb-2" style="max-height:120px;">
        @else
            <span>No cover image uploaded.</span>
        @endif
    </div>
    
    <fieldset class="text has-top-title">
        <label>Replace Cover Image</label>
        <input type="file" name="cover_image" class="" tabindex="2" aria-required="true" accept="image/*">
        @error('cover_image')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    
    <div class="form-group mb-3">
        <div class="upload-image-wrap">
            <div class="text">Current Gallery Images</div>
            <div class="list">
                @foreach($estate->images as $image)
                <div class="item">
                    <img src="{{ asset('storage/uploads/estates/gallery/'.$image->image_path) }}" alt="">
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
    
    {{-- Dropzone container for gallery images --}}
    <fieldset class="text has-top-title">
        <label>Add More Gallery Images</label>
        <div class="dropzone" id="estate-dropzone"></div>
        @error('gallery')<div class="text-danger">{{ $message }}</div>@enderror
    </fieldset>
    
    <div class="form-group mb-3" style="text-align: right;">
        <button type="submit" class="tf-button-primary">Update Estate</button>
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
    let form = document.querySelector("#estate-form");
    let isSubmitting = false;
    
    if (!form) {
        console.error("Form with ID 'estate-form' not found!");
        return;
    }

    let myDropzone = new Dropzone("#estate-dropzone", {
        url: form.action,             // Laravel route
        method: "POST",               // Use POST for file uploads
        autoProcessQueue: false,      // don't upload immediately
        uploadMultiple: true,         // send all in one request
        parallelUploads: 10,
        maxFiles: 10,
        maxFilesize: 10,              // MB
        paramName: "gallery",         // Laravel will see `gallery[]`
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
        
        document.querySelectorAll("#estate-form input, #estate-form select, #estate-form textarea")
            .forEach(function (el) {
                if (el.name) {
                    if (el.type === "checkbox") {
                        if (el.name === "amenities[]") {
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
        window.location.href = "{{ route('admin.estates.index') }}";
    });

    myDropzone.on("errormultiple", function (files, response) {
        isSubmitting = false;
        console.error(response);
        alert("Error uploading estate");
    });

    // Handle delete image buttons
    document.querySelectorAll('.delete-image-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageId = this.getAttribute('data-image-id');
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.estates.deleteImage", ":id") }}'.replace(':id', imageId);
                
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