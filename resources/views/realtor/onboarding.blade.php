@extends('admin.layouts.app')

@section('title')
    {{ auth()->user()->onboarding_completed_at ? 'Edit profile' : 'Complete your profile' }}
@endsection

@section('content')
<div class="d-flex justify-content-center">
    <div class="wg-box pl-44 mb-20 w-100" style="max-width: 720px;">
        <h3 class="mb-10 text-center">{{ auth()->user()->onboarding_completed_at ? 'Update your realtor profile' : 'Complete your realtor profile' }}</h3>
        <p class="text-muted mb-25 text-center">This information appears on your listings and in the team directory.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-20">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('realtor.onboarding.update') }}" method="POST" enctype="multipart/form-data" class="form-bacsic-infomation flex gap30 flex-column">
            @csrf
            @method('PUT')

            <x-text-input2 title="Full name" name="name" :value="old('name', auth()->user()->name)" required />
            <x-text-input2 title="Realty / brand name" name="realty_display_name" :value="old('realty_display_name', auth()->user()->realty_display_name)" required placeholder="e.g. Strategic Pillars Realty" />
            <x-text-input2 title="Phone" name="phone" :value="old('phone', auth()->user()->phone)" required />
            <x-textarea2 name="bio" title="Bio (optional)" :value="old('bio', auth()->user()->bio)" />

            <fieldset class="text has-top-title">
                <label>Photo or logo</label>
                <input type="file" name="avatar" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp">
                <small class="text-muted d-block mt-6">JPG, PNG, GIF, or WebP up to 10 MB.</small>
                @error('avatar')<div class="text-danger">{{ $message }}</div>@enderror
                @if(auth()->user()->avatarUrl())
                    <div class="mt-10">
                        <img src="{{ auth()->user()->avatarUrl() }}" alt="" style="max-width: 120px; border-radius: 8px;">
                    </div>
                @endif
            </fieldset>

            <button type="submit" class="tf-button-primary">Save profile</button>
        </form>
    </div>
</div>
@endsection
