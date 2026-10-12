@extends('layouts.app')

@section('title', 'Our Agents | Strategic Pillars')
@section('meta_description', 'Meet the Strategic Pillars team: expert agents and staff in Lagos real estate, shortlets, and interiors.')

@section('content')
                <x-page-header
                    title="Our Team"
                    subtitle="Meet the people behind Strategic Pillars."
                    :items="[
                        ['label' => 'Home', 'url' => route('home')],
                        ['label' => 'Team'],
                    ]"
                />
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            @foreach($agents as $agent)
            <div class="col-lg-4">
                                <div class="sidebar">
                                    <div class="sidebar-item sidebar-info">
                                        <div class="image">
                                            <img src="{{ asset('/storage/uploads/team/'.$agent->photo) }}" alt="">
                                        </div>
                                        <ul>
                                            <li>
                                                <h5 class="card-title">{{ $agent->name }}</h5>
                                            </li>
                                            <li>
                                                <p>{{ $agent->bio }}</p>
                                            </li>
                                            <li>
                                                <div class="title">Role:</div>
                                                <p>{{ $agent->role }}</p>
                                            </li>
                                            @if($agent->phone)
                                            <li>
                                                <div class="title">Phone:</div>
                                                <p><a href="tel:{{ $agent->phone }}">{{ $agent->phone }}</a></p>
                                            </li>
                                            @endif
                                            @if($agent->email)
                                            <li>
                                                <div class="title">Email:</div>
                                                <p><a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a></p>
                                            </li>
                                            @endif
                                            <li>
                                                <div class="title">Socials</div>
                                                <div class="wg-social style-black">
                                                    <ul class="list-social">
                                                        @if($agent->social_links && is_array($agent->social_links))
                                                            @foreach($agent->social_links as $social)
                                                                @if($social['platform'] === 'facebook')
                                                                    <li><a href="https://facebook.com/{{ $social['username'] }}" target="_blank"><i class="icon-facebook"></i></a></li>
                                                                @elseif($social['platform'] === 'twitter')
                                                                    <li><a href="https://twitter.com/{{ $social['username'] }}" target="_blank"><i class="icon-twitter"></i></a></li>
                                                                @elseif($social['platform'] === 'instagram')
                                                                    <li><a href="https://instagram.com/{{ $social['username'] }}" target="_blank"><i class="icon-instagram"></i></a></li>
                                                                @elseif($social['platform'] === 'linkedin')
                                                                    <li><a href="https://linkedin.com/in/{{ $social['username'] }}" target="_blank"><i class="icon-linkedin2"></i></a></li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>  
                                    </div>  
                                    </div>  
            @endforeach
        </div>
    </div>
</section>
@endsection 