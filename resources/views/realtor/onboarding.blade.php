@extends('realtor.layouts.app')

@section('title')
    {{ auth()->user()->onboarding_completed_at ? 'Edit profile' : 'Complete your profile' }}
@endsection

@section('content')
<div class="wg-box" style="max-width: 640px;">
    <h3 class="mb-10">{{ auth()->user()->onboarding_completed_at ? 'Update your realtor profile' : 'Complete your realtor profile' }}</h3>
    <p class="text-muted mb-25">This information appears on your listings and in the team directory.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-20">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('realtor.onboarding.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-column gap20">
        @csrf
        @method('PUT')

        <fieldset class="text">
            <label class="d-block mb-6">Full name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
        </fieldset>

        <fieldset class="text">
            <label class="d-block mb-6">Realty / brand name</label>
            <input type="text" name="realty_display_name" class="form-control" value="{{ old('realty_display_name', auth()->user()->realty_display_name) }}" required placeholder="e.g. Strategic Pillars Realty">
        </fieldset>

        <fieldset class="text">
            <label class="d-block mb-6">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required>
        </fieldset>

        <fieldset class="text">
            <label class="d-block mb-6">Bio (optional)</label>
            <textarea name="bio" class="form-control" rows="4" placeholder="A short introduction for clients">{{ old('bio', auth()->user()->bio) }}</textarea>
        </fieldset>

        <fieldset class="text">
            <label class="d-block mb-6">Photo or logo</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
            @if(auth()->user()->avatarUrl())
                <div class="mt-10">
                    <img src="{{ auth()->user()->avatarUrl() }}" alt="" style="max-width: 120px; border-radius: 8px;">
                </div>
            @endif
        </fieldset>

        <button type="submit" class="tf-button-primary">Save profile</button>
    </form>
</div>
@endsection
