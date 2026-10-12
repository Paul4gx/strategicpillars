@extends('admin.layouts.app')

@section('content')
<div class="wg-box pl-44 mb-20">
    <h1 class="h3 mb-50 text-gray-800">Edit Team Member</h1>
    <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data" class="form-bacsic-infomation flex gap30 flex-column">
        @csrf
        @method('PUT')

        <x-text-input2 title="Name" type="text" name="name" type-class="text" value="{{ old('name', $team->name) }}" required/>
        <x-text-input2 title="Role/Title" type="text" name="role" type-class="text" value="{{ old('role', $team->role) }}" required/>
        <x-text-input2 title="Email" type="email" name="email" type-class="text" value="{{ old('email', $team->email) }}" required/>

        @if($team->user_id && $team->user)
            <div class="alert alert-info py-10 px-15 mb-15">
                <strong>Realtor login {{ $team->user->isActive() ? 'active' : 'deactivated' }}.</strong>
                @if($team->user->isActive())
                    This person can sign in at the usual login page and use the realtor workspace with {{ $team->user->email }}.
                @else
                    This login exists but is currently blocked from signing in.
                @endif
            </div>
        @else
            <fieldset class="border rounded p-15 mb-15" style="border-color: #dee2e6;">
                <label class="d-flex align-items-start gap10 cursor-pointer mb-0">
                    <input type="checkbox" name="create_property_account" value="1" class="mt-5" @checked(old('create_property_account'))>
                    <span>
                        <strong>Create realtor login for this person</strong>
                        <span class="d-block text-muted small mt-5">Adds a realtor account linked to this profile and emails them a link to set their password. Use this if they should upload and manage listings.</span>
                    </span>
                </label>
            </fieldset>
        @endif

        <x-text-input2 title="Phone" type="tel" name="phone" type-class="text" value="{{ old('phone', $team->phone) }}" required/>
        <x-textarea2 name="bio" title="Bio" value="{{ old('bio', $team->bio) }}" required/>
        <fieldset class="border rounded p-2" style="border-color: #dee2e6;">
            <label class="d-flex align-items-start gap10 cursor-pointer mb-0">
                <input type="hidden" name="is_visible" value="0">
                <input type="checkbox" name="is_visible" value="1" class="" @checked(old('is_visible', $team->is_visible))>
                <span>
                    <strong>Show this profile on public pages</strong>
                    <span class="d-block text-muted small">Turn this off to hide the team member from the homepage and agents page without deleting the profile.</span>
                </span>
            </label>
        </fieldset>
        <x-text-input2 title="Sort Order" type="number" name="sort_order" type-class="text" value="{{ old('sort_order', $team->sort_order) }}" required/>
        
        <div class="form-group">
            <label>Social Links</label>
            <div id="social-links">
                @php 
                    $socialLinks = old('social_links', $team->social_links ?? []);
                    $socialIndex = 0;
                @endphp
                
                @if($socialLinks && is_array($socialLinks) && count($socialLinks) > 0)
                    @foreach($socialLinks as $index => $link)
                        @if(is_array($link) && isset($link['platform']) && isset($link['username']))
                            <div class="input-group mb-2">
                                <select name="social_links[{{ $index }}][platform]" class="form-control" style="max-width: 150px;">
                                    <option value="facebook" {{ $link['platform'] == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option value="instagram" {{ $link['platform'] == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="twitter" {{ $link['platform'] == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                    <option value="linkedin" {{ $link['platform'] == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                    <option value="youtube" {{ $link['platform'] == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                </select>
                                <input type="text" name="social_links[{{ $index }}][username]" class="form-control" placeholder="username" value="{{ $link['username'] }}">
                                <div class="input-group-append">
                                    <button class="btn btn-danger remove-social" type="button">&times;</button>
                                </div>
                            </div>
                            @php $socialIndex++; @endphp
                        @endif
                    @endforeach
                @endif
                
                @if($socialIndex == 0)
                    {{-- Default social links if none exist --}}
                    <div class="input-group mb-2">
                        <select name="social_links[0][platform]" class="form-control" style="max-width: 150px;">
                            <option value="facebook" selected>Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="youtube">YouTube</option>
                        </select>
                        <input type="text" name="social_links[0][username]" class="form-control" placeholder="username">
                        <div class="input-group-append">
                            <button class="btn btn-danger remove-social" type="button">&times;</button>
                        </div>
                    </div>
                    @php $socialIndex = 1; @endphp
                @endif
            </div>
            <button type="button" class="btn btn-secondary" id="add-social">Add Social Link</button>
        </div>

        <div class="form-group">
         <div class="upload-image-wrap">
                                    <div class="text">Profile Photo</div>
                                    <div class="list">
                                         @if($team->photo)            
                                        <div class="item">
                                            <img id="current-photo" src="{{ asset('storage/uploads/team/'.$team->photo) }}" alt="">
                                            <ul class="">
                                            </ul>
                                        </div>
                                        @else
                                        <div class="item" id="photo-preview-container" style="display: none;">
                                            <img id="current-photo" src="" alt="">
                                            <ul class="">
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="item">
                                            <label class="uploadfile">
                                                <input type="file" class="" name="photo" id="photo-input" accept="image/*">
                                                <i class="flaticon-gallery"></i>
                                                <div>Upload</div>
                                            </label>
                                        </div>
                                    </div>
                                    <p>Max file size is 1MB, Best dimension: 1x1(Square) And Suitable files ext. are .jpg &amp; .png</p>
                                </div>
        </div>

        <button type="submit" class="tf-button-primary">Update Team Member</button>
    </form>
</div>
@endsection 
@push('scripts')
<script>
// Initialize social index based on existing social links
let socialIndex = document.querySelectorAll('#social-links .input-group').length;

document.getElementById('add-social').onclick = function() {
    var container = document.getElementById('social-links');
    var div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <select name="social_links[${socialIndex}][platform]" class="form-control" style="max-width: 150px;">
            <option value="facebook">Facebook</option>
            <option value="instagram">Instagram</option>
            <option value="twitter">Twitter</option>
            <option value="linkedin">LinkedIn</option>
            <option value="youtube">YouTube</option>
        </select>
        <input type="text" name="social_links[${socialIndex}][username]" class="form-control" placeholder="username">
        <div class="input-group-append">
            <button class="btn btn-danger remove-social" type="button">&times;</button>
        </div>
    `;
    container.appendChild(div);
    socialIndex++;
};

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('remove-social')) {
        e.target.closest('.input-group').remove();
    }
});
</script>
@endpush 