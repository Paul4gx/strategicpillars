@extends('admin.layouts.app')

@section('content')
<div class="wg-box" style="max-width: 560px;">
    <h3 class="mb-10">Invite a realtor</h3>
    <p class="text-muted mb-25">Creates a realtor login. They receive an email to choose a password, then complete their public profile.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-20">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.team.invite.store') }}" method="POST" class="flex flex-column gap20">
        @csrf
        <fieldset>
            <label class="d-block mb-6">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </fieldset>
        <fieldset>
            <label class="d-block mb-6">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </fieldset>
        <div class="flex gap15 flex-wrap">
            <button type="submit" class="tf-button-primary">Send invitation</button>
            <a href="{{ route('admin.team.index') }}" class="tf-button-default">Cancel</a>
        </div>
    </form>
</div>
@endsection
