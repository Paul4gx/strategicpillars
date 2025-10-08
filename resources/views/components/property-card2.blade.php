@props(['property'])
<div class="swiper-slide">
                                                <div class="box-dream wow fadeInUp" data-wow-delay="0.1s">
                                                    <div class="image">
                                                                <div class="list-tags">
                                                                    @if($property->status === 'For Rent')
                                                                        <a href="#" class="tags-item for-rent">FOR RENT</a>
                                                                    @else
                                                                        <a href="#" class="tags-item for-sell">FOR SALE</a>
                                                                    @endif
                                                                    @if($property->featured)
                                                                        <a href="#" class="tags-item featured">FEATURED</a>
                                                                    @endif
                                                                </div>
                                                        <div class="button-heart"><i class="flaticon-heart-1"></i></div>
                                                        <div class="swiper-container slider-box-dream arrow-style-1 pagination-style-1">
                                                            <div class="swiper-wrapper">
                                                                               @foreach($property->images as $image)
                                                                                <div class="swiper-slide">
                                                                                    <div class="w-full">
                                                                                        <img class="w-full" src="{{ $image->thumbnail_url }}" alt="{{ $property->title }}" loading="lazy">
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                            </div>
                                                            <div class="swiper-pagination box-dream-pagination"></div>
                                                            <div class="box-dream-next swiper-button-next"></div>
                                                            <div class="box-dream-prev swiper-button-prev"></div>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <div class="head">
                                                            <div class="title">
                                                                 <a href="{{ route('properties.show', $property->slug) }}">{{ $property->title }}</a>
                                                            </div>
                                                            <div class="price">
                                                                @if($property->status === 'For Rent')
                                                                    {{ $property->formatted_price }}/month
                                                                @else
                                                                    {{ $property->formatted_price }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="location">
                                                            <div class="icon">
                                                                <i class="flaticon-location"></i>
                                                            </div>
                                                            <p>{{ $property->address }}, {{ $property->city }}</p>
                                                        </div>
                                                        <div class="icon-box">
                                                            <div class="item">
                                                                <i class="flaticon-hotel"></i>
                                                                <p>{{ $property->bedrooms }} Beds</p>
                                                            </div>
                                                            <div class="item">
                                                                <i class="flaticon-bath-tub"></i>
                                                                <p>{{ $property->bathrooms }} Baths</p>
                                                            </div>
                                                            <div class="item">
                                                                <i class="flaticon-minus-front"></i>
                                                                <p>{{ $property->area }} Sqft</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>