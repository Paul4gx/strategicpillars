@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Team Member Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $teamMember->name }}</h4>
            <p><strong>Role:</strong> {{ $teamMember->role }}</p>
            <p><strong>Bio:</strong> {{ $teamMember->bio }}</p>
            <p><strong>Sort Order:</strong> {{ $teamMember->sort_order }}</p>
            @if($teamMember->photo)
                <div class="mb-3">
                    <strong>Profile Photo:</strong><br>
                    <img src="{{ asset('storage/uploads/team/'.$teamMember->photo) }}" alt="Profile" style="max-width:120px;">
                </div>
            @endif
            @if($teamMember->social_links && is_array($teamMember->social_links))
                <div class="mb-3">
                    <strong>Social Links:</strong><br>
                    @foreach($teamMember->social_links as $link)
                        <a href="{{ $link }}" target="_blank">{{ $link }}</a><br>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Back to Team</a>
</div>
@endsection 