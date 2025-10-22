@extends('layouts.app')

@section('title', $property->title . ' | Strategic Pillars')
@section('meta_description', Str::limit($property->short_description, 150))

@push('styles')
<style>
.long-description {
    margin-top: 1rem;
    line-height: 1.6;
}

.long-description h1,
.long-description h2,
.long-description h3,
.long-description h4,
.long-description h5,
.long-description h6 {
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #333;
}

.long-description h1 { font-size: 1.8rem; }
.long-description h2 { font-size: 1.6rem; }
.long-description h3 { font-size: 1.4rem; }
.long-description h4 { font-size: 1.2rem; }
.long-description h5 { font-size: 1.1rem; }
.long-description h6 { font-size: 1rem; }

.long-description p {
    margin-bottom: 1rem;
    color: #666;
}

.long-description ul,
.long-description ol {
    margin-bottom: 1rem;
    padding-left: 2rem;
}

.long-description li {
    margin-bottom: 0.5rem;
    color: #666;
}

.long-description table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
}

.long-description table th,
.long-description table td {
    padding: 0.75rem;
    border: 1px solid #ddd;
    text-align: left;
}

.long-description table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.long-description a {
    color: #007bff;
    text-decoration: none;
}

.long-description a:hover {
    text-decoration: underline;
}

.long-description strong {
    font-weight: 600;
    color: #333;
}

.long-description em {
    font-style: italic;
}

.long-description blockquote {
    margin: 1rem 0;
    padding: 1rem;
    border-left: 4px solid #007bff;
    background-color: #f8f9fa;
    font-style: italic;
}

.long-description img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}
</style>
@endpush

@section('content')
                <div class="property-single-wrap v2">
                    <div class="cl-container">
        <div class="row">
                            <div class="col-12">
                                <div class="flex items-center justify-between gap30 flex-wrap pt-30 pb-30">
                                    <ul class="breadcrumbs style-1 justify-start">
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li>/</li>
                                        <li><a href="{{ route('properties.index') }}">Properties</a></li>
                                        <li>/</li>
                                        <li>{{ $property->property_type }}</li>
                                    </ul>
                                    <div class="list-icons-page">
                                        {{-- <div class="item">
                                            <div class="icon">
                                                <i class="flaticon-heart"></i>
                                            </div>
                                            <p>Save</p>
                                        </div> --}}
                                        @auth
                                        @if(auth()->user()->is_admin)
                                            <div class="item" onclick="window.location.href='{{ route('admin.properties.edit', $property) }}'">
                                                    <div class="icon">
                                                        <i class="flaticon-edit"></i>
                                                    </div>
                                                    <p>Edit</p>
                                            </div>
                                        @endif
                                    @endauth
                                        <div class="item">
                                            <div class="icon">
                                                <i class="flaticon-outbox"></i>
                                            </div>
                                            <p>Share</p>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="head-title">
                                    <div>
                                        <h3 class="wow fadeInUp">{{ $property->title }}</h3>
                                        <div class="location wow fadeInUp">
                                            <div class="icon">
                                                <i class="flaticon-location"></i>
                                            </div>
                                            <div class="text-content">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</div>
                                        </div>
                                    </div>
                                    <div class="wow fadeInUp">
                                        <div class="square">Price</div>
                                        <div class="price">₦{{ number_format($property->price) }}</div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-8">
                                <div class="content-wrap">
                                    <div class="thumbs-slider arrow-style-1">
                                        <div class="swiper-container slider-thumbs-gallery-2">
                                            <div class="swiper-wrapper">
                                                @foreach($property->images as $key => $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset('storage/uploads/properties/' . $image->image_path) }}" alt="Property Image">
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-button-next has-background thumbs-next"></div>
                                            <div class="swiper-button-prev has-background thumbs-prev"></div>
                                        </div>
                                        <div class="swiper-container slider-thumbs-gallery-1">
                                            <div class="swiper-wrapper">
                                              @foreach($property->images as $key => $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset('storage/uploads/properties/' . $image->image_path) }}" alt="Property Image">
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-items">
                                        <div class="item wow fadeInUp">
                                            <div class="icon">
                                                <i class="flaticon-city"></i>
                                            </div>
                                            <div class="text-content">{{ $property->property_type }}</div>
                                        </div>
                                        @if($property->year_built)
                                        <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="icon">
                                                <i class="flaticon-hammer"></i>
                                            </div>
                                            <div class="text-content">Built in {{ $property->year_built }}</div>
                                        </div>
                                        @endif
                                        @if($property->area)
                                        <div class="item wow fadeInUp" data-wow-delay="0.2s">
                                            <div class="icon">
                                                <i class="flaticon-minus-front"></i>
                                            </div>
                                            <div class="text-content">{{ number_format($property->area) }} Sq Ft</div>
                                        </div>
                                        @endif
                                        @if($property->bedrooms)
                                        <div class="item wow fadeInUp">
                                            <div class="icon">
                                                <i class="flaticon-hotel"></i>
                                            </div>
                                            <div class="text-content">{{ $property->bedrooms }} Bedroom{{ $property->bedrooms > 1 ? 's' : '' }}</div>
                                        </div>
                                        @endif
                                        @if($property->bathrooms)
                                        <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="icon">
                                                <i class="flaticon-bath-tub"></i>
                                            </div>
                                            <div class="text-content">{{ $property->bathrooms }} Bathroom{{ $property->bathrooms > 1 ? 's' : '' }}</div>
                                        </div>
                                        @endif
                                        @if($property->parking_spaces)
                                        <div class="item wow fadeInUp" data-wow-delay="0.2s">
                                            <div class="icon">
                                                <i class="flaticon-garage"></i>
                                            </div>
                                            <div class="text-content">{{ $property->parking_spaces }} Parking Space{{ $property->parking_spaces > 1 ? 's' : '' }}</div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="desc">
                                        <h4 class="wow fadeInUp">Description</h4>
                                        <div class="wow fadeInUp">
                                            <p>{{$property->short_description}}</p>
                                            @if($property->long_description)
                                                <div class="long-description">
                                                    {!! $property->long_description !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="address">
                                        <div class="flex items-center justify-between gap30 flex-wrap wow fadeInUp">
                                            <h4 class="mb-0">Address</h4>
                                            <a href="#" class="tf-button-green"><i class="flaticon-location"></i>Open On Google Maps</a>
                                        </div>
                                        <div class="list-item">
                                            <div class="item wow fadeInUp">
                                                <div class="text">Address</div>
                                                <p>{{$property->address}}</p>
                                            </div>
                                            <div class="item wow fadeInUp"  data-wow-delay="0.1s">
                                                <div class="text">State</div>
                                                <p>{{$property->state}}</p>
                                            </div>
                                            <div class="item wow fadeInUp">
                                                <div class="text">City</div>
                                                <p>{{$property->city}}</p>
                                            </div>
                                            
                                            <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                                <div class="text">Country</div>
                                                <p>Nigeria</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4 class="wow fadeInUp">Details</h4>
                                        <div class="list-item">
                                            <div class="item wow fadeInUp">
                                                <div class="text">Property ID:</div>
                                                <p>SPR-00{{$property->id}}</p>
                                            </div>
                                            <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                                <div class="text">Garage:</div>
                                                <p>{{$property->parking_spaces}}</p>
                                            </div>
                                            <div class="item wow fadeInUp">
                                                <div class="text">Price:</div>
                                                <p>₦{{$property->price}}</p>
                                            </div>
                                            <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                                <div class="text">Garage Size:</div>
                                                <p>{{$property->parking_spaces}} SqFt</p>
                                            </div>
                                            @if($property->area)
                                            <div class="item wow fadeInUp">
                                                <div class="text">Property Size:</div>
                                                <p>{{ number_format($property->area) }} Sq Ft</p>
                                            </div>
                                            @endif
                                            @if($property->year_built)
                                            <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                                <div class="text">Year Built:</div>
                                                <p>{{ $property->year_built }}</p>
                                            </div>
                                            @endif
                                            @if($property->bedrooms)
                                            <div class="item wow fadeInUp">
                                                <div class="text">Bedrooms:</div>
                                                <p>{{ $property->bedrooms }}</p>
                                            </div>
                                            @endif
                                            <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                                <div class="text">Property Type:</div>
                                                <p>{{ $property->property_type }}</p>
                                            </div>
                                            @if($property->bathrooms)
                                            <div class="item wow fadeInUp">
                                                <div class="text">Bathrooms:</div>
                                                <p>{{ $property->bathrooms }}</p>
                                            </div>
                                            @endif
                                            <div class="item wow fadeInUp" data-wow-delay="0.1s">
                                                <div class="text">Property Status:</div>
                                                <p>{{ ucfirst(str_replace('_', ' ', $property->status)) }}</p>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="features">
                                        <h4 class="wow fadeInUp">Facts & Features</h4>
                                        <p class="wow fadeInUp">Discover the exceptional amenities and features that make this property truly special. From modern conveniences to luxury touches, every detail has been carefully considered.</p>
                                        
                                        @if($property->property_features && count($property->property_features) > 0)
                                            @php
                                                // Group features by category for better organization
                                                $amenities = [
                                                    "Climate & Comfort" => [
                                                        "Air Conditioning", "Heating", "Ceiling Fans", "Ventilation System", 
                                                        "Humidifier / Dehumidifier", "Insulation / Energy-efficient Windows"
                                                    ],
                                                    "Interior Features" => [
                                                        "Window Coverings", "Flooring", "Built-in Wardrobes", "Walk-in Closet", 
                                                        "Fireplace", "Skylights", "Smart Home Controls", "Soundproof Walls"
                                                    ],
                                                    "Kitchen & Dining" => [
                                                        "Refrigerator / Freezer", "Microwave", "Oven", "Stove / Cooktop", 
                                                        "Dishwasher", "Wine Cooler", "Pantry", "Breakfast Bar / Island", "Garbage Disposal"
                                                    ],
                                                    "Bathrooms & Wellness" => [
                                                        "Bathtub", "Sauna", "Steam Room", "Shower Cabin", 
                                                        "Double Sink Vanity", "Heated Towel Racks"
                                                    ],
                                                    "Laundry & Utilities" => [
                                                        "Washer", "Dryer", "Laundry Room", "Ironing Facilities", 
                                                        "Clothesline / Drying Rack", "Water Heater", "Backup Generator", "Solar Panels"
                                                    ],
                                                    "Technology & Connectivity" => [
                                                        "WiFi / Broadband Internet", "TV Cable / Satellite TV", "Home Theater", 
                                                        "Intercom System", "Smart Door Locks / Video Doorbell", "EV Charging Station"
                                                    ],
                                                    "Lifestyle & Recreation" => [
                                                        "Swimming Pool", "Jacuzzi / Hot Tub", "Gym / Fitness Center", "Barbeque / Outdoor Grill", 
                                                        "Game Room", "Cinema Room", "Library / Study Room", "Wine Cellar", "Kids' Play Area"
                                                    ],
                                                    "Outdoor & Landscaping" => [
                                                        "Lawn / Garden", "Patio / Deck", "Balcony / Terrace", "Rooftop Access", 
                                                        "Outdoor Kitchen", "Fire Pit", "Pergola / Gazebo", "Fencing / Privacy Screens", "Sprinkler / Irrigation System"
                                                    ],
                                                    "Parking & Access" => [
                                                        "Garage", "Carport", "Driveway", "Visitor Parking", 
                                                        "Gated Entry", "Handicap Accessibility"
                                                    ],
                                                    "Office & Commercial Features" => [
                                                        "Conference / Meeting Rooms", "Reception Area", "Break Room / Kitchenette", 
                                                        "Co-working Spaces", "Printing / Copy Room", "Security Desk / Concierge", "Elevator Access", "Commercial HVAC System"
                                                    ],
                                                    "Safety & Security" => [
                                                        "Smoke Detectors", "Fire Sprinkler System", "Fire Extinguishers", 
                                                        "Security Cameras", "Burglar Alarm", "24hr Security / Gated Community", "Safe Room / Panic Room"
                                                    ],
                                                    "Building & Structural" => [
                                                        "Basement", "Attic", "Storage Room", "Workshop / Tool Shed", 
                                                        "High Ceilings", "Open Floor Plan", "Soundproof Windows", "Energy-efficient Design"
                                                    ]
                                                ];
                                                
                                                // Group property features by category
                                                $groupedFeatures = [];
                                                foreach($property->property_features as $feature) {
                                                    foreach($amenities as $category => $features) {
                                                        if(in_array($feature, $features)) {
                                                            $groupedFeatures[$category][] = $feature;
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            
                                            <ul>
                                                @foreach($groupedFeatures as $category => $features)
                                                    @if(count($features) > 0)
                                                        <li>
                                                            <h5 class="wow fadeInUp">{{ $category }}</h5>
                                                            <div class="wrap-check-ellipse wow fadeInUp">
                                                                @foreach($features as $feature)
                                                                    <div class="check-ellipse-item">
                                                                        <div class="icon">
                                                                            <i class="flaticon-check"></i>
                                                                        </div>
                                                                        <p>{{ $feature }}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="wrap-check-ellipse wow fadeInUp">
                                                <div class="check-ellipse-item">
                                                    <div class="icon">
                                                        <i class="flaticon-check"></i>
                                                    </div>
                                                    <p>Modern Design</p>
                                                </div>
                                                <div class="check-ellipse-item">
                                                    <div class="icon">
                                                        <i class="flaticon-check"></i>
                                                    </div>
                                                    <p>Quality Construction</p>
                                                </div>
                                                <div class="check-ellipse-item">
                                                    <div class="icon">
                                                        <i class="flaticon-check"></i>
                                                    </div>
                                                    <p>Prime Location</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if($property->video_link)
                                    <div class="video">
                                        <h4 class="wow fadeInUp">Video</h4>
                                        <div class="video-wrap">
                                            <img src="{{ asset('images/image-box/video-2.jpg') }}" alt="Property Video">
                                            <a href="{{ $property->video_link }}" class="popup-youtube">
                                                <div class="icon">
                                                    <i class="flaticon-play"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                    @if($property->brochure)
                    <div class="mb-3">
                        <a href="{{ asset('storage/uploads/brochures/' . $property->brochure) }}" target="_blank" class="btn btn-outline-secondary">Download Brochure</a>
                    </div>
                @endif
                <div class="map">
                    <h4 class="wow fadeInUp">Location</h4>
                    <div class="wrap-map-v1">
                        <iframe src="https://www.google.com/maps?q={{ urlencode($property->address . ', ' . $property->city . ', ' . $property->state) }}&output=embed" width="100%" height="100%" style="border:0;border-radius: 16px;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>


                                </div>
                        </div>
                        <div class="col-xl-4">
                                <div class="property-single-sidebar">
                                    <div class="sidebar-item sidebar-schedule">
                                        <div class="sidebar-title ">Schedule a tour</div>
                                        <form class="form-schedule">
                                            <div class="cols">
                                                <fieldset class="message">
                                                    <input type="date" name="date" value="{{ date('Y-m-d') }}">
                                                </fieldset>
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">Please Select Time</span>
                                                    <ul class="list ">    
                                                        <li data-value="" class="option selected">6 AM</li>
                                                        <li data-value="For Ren" class="option">12 AM</li>
                                                        <li data-value="Sold" class="option">6 PM</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="widget-tabs style-4">
                                                <ul class="widget-menu-tab">
                                                    <li class="item-title active">
                                                        <span class="inner">In Person</span>
                                                    </li>
                                                    <li class="item-title">
                                                        <span class="inner">Video Chat</span>
                                                    </li>
                                                </ul>
                                                <div class="widget-content-tab">
                                                    <div class="widget-content-inner active">
                                                        <div class="cols">
                                                            <fieldset class="name">
                                                                <input type="text" placeholder="Name" class="" name="text" tabindex="2" value="" aria-required="true" required="">
                                                            </fieldset>
                                                            <fieldset class="phone">
                                                                <input type="number" placeholder="Phone" class="" name="number" tabindex="2" value="" aria-required="true" required="">
                                                            </fieldset>
                                                            <fieldset class="email">
                                                                <input type="email" placeholder="Email" class="" name="email" tabindex="2" value="" aria-required="true" required="">
                                                            </fieldset>
                                                        </div>
                                                        <fieldset class="message">
                                                            <textarea name="message" rows="4" placeholder="Your Comment" class="" tabindex="2" aria-required="true" required=""></textarea>
                                                        </fieldset>
                                                    </div>
                                                    <div class="widget-content-inner">
                                                        <div class="cols">
                                                            <fieldset class="name">
                                                                <input type="text" placeholder="Name" class="" name="text" tabindex="2" value="" aria-required="true" required="">
                                                            </fieldset>
                                                            <fieldset class="phone">
                                                                <input type="number" placeholder="Phone" class="" name="number" tabindex="2" value="" aria-required="true" required="">
                                                            </fieldset>
                                                            <fieldset class="email">
                                                                <input type="email" placeholder="Email" class="" name="email" tabindex="2" value="" aria-required="true" required="">
                                                            </fieldset>
                                                        </div>
                                                        <fieldset class="message">
                                                            <textarea name="message" rows="4" placeholder="Your Comment" class="" tabindex="2" aria-required="true" required=""></textarea>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-submit">
                                                <button class="tf-button-primary w-full" type="submit">Submit a Tour Request<i class="icon-arrow-right-add"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-12">
                                @if($similarProperties && count($similarProperties) > 0)
                                    <div class="smilar-homes">
                                        <h4 class="wow fadeInUp">Similar Properties</h4>
                                        <div class="row">
                                            @foreach($similarProperties as $index => $similarProperty)
                                                <div class="col-md-4 mb-4">
                                                    <x-property-card2 :property="$similarProperty" />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                        </div>
        </div>
        
        </div>
    </div>
</div>
@endsection 