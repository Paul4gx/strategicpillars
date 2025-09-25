@extends('layouts.app')

@section('title', 'Properties | Strategic Pillars')
@section('meta_description', 'Browse all available properties for sale, rent, and off-plan at Strategic Pillars.')

@section('content')
                <!-- flat-title -->
                <div class="flat-title">
                    <div class="cl-container full">
                        <div class="row">
                            <div class="col-12">
                                <div class="content">
                                    <h2>Our Properties</h2>
                                    <ul class="breadcrumbs">
                                        <li><a href="{{route('home')}}">Home</a></li><li>/</li><li>Our Properties</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /flat-title -->
<section class="py-5 bg-light">
    <div class="container">
                    <form method="GET" class="form-search-home5 background-secondary wow fadeInUp" style="margin-top:-50px; margin-bottom: 60px;">
                        <div class="list">
                            <div class="group-form form-search-content">
                                <div class="form-style-has-title">
                                    <div class="title">Keyword</div>
                                    <div class="relative">
                                        <fieldset class="name">
                                            <input type="text" placeholder="Enter Keyword" class="show-search style-default" name="keyword" tabindex="2" value="{{ request('keyword') }}" aria-required="true">
                                        </fieldset>
                                        <div class="style-absolute-right">
                                            <div class="style-icon-default"><i class="flaticon-magnifiying-glass"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-1"></div>
                            <div class="group-form">
                                <div class="form-style-has-title">
                                    <div class="title">Status</div>
                                    <select name="status" class="nice-select style-white">
                                        <option value="">All Status</option>
                                        <option value="available" @if(request('status') == 'available') selected @endif>Available</option>
                                        <option value="sold" @if(request('status') == 'sold') selected @endif>Sold</option>
                                        <option value="rented" @if(request('status') == 'rented') selected @endif>Rented</option>
                                        <option value="off-plan" @if(request('status') == 'off-plan') selected @endif>Off Plan</option>
                                        <option value="upcoming" @if(request('status') == 'upcoming') selected @endif>Upcoming</option>
                                    </select>
                                </div>
                            </div>
                            <div class="divider-1"></div>
                            <div class="group-form">
                                <div class="form-style-has-title">
                                    <div class="title">Type</div>
                                    <select name="type" class="nice-select style-white">
                                        <option value="">All Type</option>
                                        @foreach($propertyTypes as $type)
                                            <option value="{{ $type }}" @if(request('type') == $type) selected @endif>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap10">
                            <div class="group-form">
                                <div class="wg-filter">
                                    <div class="tf-button-filter btn-filter"><i class="flaticon-filter"></i>Filter</div>
                                    <div class="open-filter filter-no-content" id="a1">
                                        <div>
                                            <div class="grid-3-cols mb-20">
                                                <div class="form-style-has-title">
                                                    <div class="title">City</div>
                                                    <select name="city" class="nice-select">
                                                        <option value="">All Cities</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city }}" @if(request('city') == $city) selected @endif>{{ $city }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-style-has-title">
                                                    <div class="title">Bedrooms</div>
                                                    <select name="bedrooms" class="nice-select">
                                                        <option value="">Any</option>
                                                        <option value="1" @if(request('bedrooms') == '1') selected @endif>1+ Bed</option>
                                                        <option value="2" @if(request('bedrooms') == '2') selected @endif>2+ Beds</option>
                                                        <option value="3" @if(request('bedrooms') == '3') selected @endif>3+ Beds</option>
                                                        <option value="4" @if(request('bedrooms') == '4') selected @endif>4+ Beds</option>
                                                        <option value="5" @if(request('bedrooms') == '5') selected @endif>5+ Beds</option>
                                                    </select>
                                                </div>
                                                <div class="form-style-has-title">
                                                    <div class="title">Bathrooms</div>
                                                    <select name="bathrooms" class="nice-select">
                                                        <option value="">Any</option>
                                                        <option value="1" @if(request('bathrooms') == '1') selected @endif>1+ Bath</option>
                                                        <option value="2" @if(request('bathrooms') == '2') selected @endif>2+ Baths</option>
                                                        <option value="3" @if(request('bathrooms') == '3') selected @endif>3+ Baths</option>
                                                        <option value="4" @if(request('bathrooms') == '4') selected @endif>4+ Baths</option>
                                                        <option value="5" @if(request('bathrooms') == '5') selected @endif>5+ Baths</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="grid-4-cols">
                                                <fieldset class="name">
                                                    <input type="number" placeholder="Min. Area (Sq Ft)" name="min_area" value="{{ request('min_area') }}">
                                                </fieldset>
                                                <fieldset class="name">
                                                    <input type="number" placeholder="Max. Area (Sq Ft)" name="max_area" value="{{ request('max_area') }}">
                                                </fieldset>
                                                <fieldset class="name">
                                                    <input type="number" placeholder="Min. Price (₦)" name="min_price" value="{{ request('min_price') }}">
                                                </fieldset>
                                                <fieldset class="name">
                                                    <input type="number" placeholder="Max. Price (₦)" name="max_price" value="{{ request('max_price') }}">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="title">Amenities</div>  
                                            <ul class="grid-checkbox">
                                                @php
                                                    $amenities = [
                                                        'Air Conditioning', 'Barbeque', 'Dryer', 'Gym', 'Lawn', 'Microwave',
                                                        'Refrigerator', 'Sauna', 'Swimming Pool', 'TV Cable', 'Washer', 'WiFi'
                                                    ];
                                                    $selectedAmenities = request('amenities', []);
                                                @endphp
                                                @foreach($amenities as $amenity)
                                                <li class="checkbox-item">
                                                    <label>
                                                        <p>{{ $amenity }}</p>
                                                        <input type="checkbox" name="amenities[]" value="{{ $amenity }}" 
                                                               @if(in_array($amenity, $selectedAmenities)) checked @endif>
                                                        <span class="btn-checkbox"></span>
                                                    </label>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="group-form">
                                <div class="button-submit">
                                    <button class="tf-button-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>

        <div class="row">
            @forelse($properties as $property)
                <div class="col-md-4 mb-4">
                    <x-property-card2 :property="$property" />
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No properties found.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $properties->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection 