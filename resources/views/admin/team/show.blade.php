@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Team Member Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $team->name }}</h4>
            <p><strong>Role:</strong> {{ $team->role }}</p>
            <p><strong>Email:</strong> {{ $team->email }}</p>
            <p><strong>Realtor listing access:</strong>
                @if($team->user_id && $team->user)
                    @if($team->user->isActive() && ! $team->user->onboarding_completed_at)
                        Pending setup — invited, waiting for password and profile completion ({{ $team->user->email }})
                    @elseif($team->user->isActive())
                        Active — linked login ({{ $team->user->email }})
                    @else
                        Deactivated — linked login ({{ $team->user->email }})
                    @endif
                @else
                    No — website profile only
                @endif
            </p>
            <p><strong>Website visibility:</strong> {{ $team->is_visible ? 'Visible on public pages' : 'Hidden from public pages' }}</p>
            <p><strong>Phone:</strong> {{ $team->phone }}</p>
            <p><strong>Bio:</strong> {{ $team->bio }}</p>
            <p><strong>Sort Order:</strong> {{ $team->sort_order }}</p>
            @if($team->photo)
                <div class="mb-3">
                    <strong>Profile Photo:</strong><br>
                    <img src="{{ asset('storage/uploads/team/'.$team->photo) }}" alt="Profile" style="max-width:120px;">
                </div>
            @endif
            @if($team->social_links && is_array($team->social_links))
                <div class="mb-3">
                    <strong>Social Links:</strong><br>
                    @foreach($team->social_links as $social)
                        @if(is_array($social) && ! empty($social['platform']) && ! empty($social['username']))
                            @if($social['platform'] === 'facebook')
                                <a href="https://facebook.com/{{ $social['username'] }}" target="_blank" rel="noopener">Facebook: {{ $social['username'] }}</a><br>
                            @elseif($social['platform'] === 'twitter')
                                <a href="https://twitter.com/{{ $social['username'] }}" target="_blank" rel="noopener">Twitter: {{ $social['username'] }}</a><br>
                            @elseif($social['platform'] === 'instagram')
                                <a href="https://instagram.com/{{ $social['username'] }}" target="_blank" rel="noopener">Instagram: {{ $social['username'] }}</a><br>
                            @elseif($social['platform'] === 'linkedin')
                                <a href="https://linkedin.com/in/{{ $social['username'] }}" target="_blank" rel="noopener">LinkedIn: {{ $social['username'] }}</a><br>
                            @endif
                        @elseif(is_string($social))
                            <a href="{{ $social }}" target="_blank" rel="noopener">{{ $social }}</a><br>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Back to Team</a>
</div>
@endsection 