@extends('admin.layouts.app')

@section('content')
<div class="wg-box pl-44 mb-20">
    <h1 class="h3 mb-4 text-gray-800">Edit Team Member</h1>
    <form action="{{ route('admin.team.update', $teamMember) }}" method="POST" enctype="multipart/form-data" class="form-bacsic-infomation flex gap30 flex-column">
        @csrf
        @method('PUT')

        <x-text-input2 title="Name" type="text" name="name" type-class="text" value="{{ old('name', $teamMember->name) }}" required/>
        <x-text-input2 title="Role/Title" type="text" name="role" type-class="text" value="{{ old('role', $teamMember->role) }}" required/>
        <x-textarea2 name="bio" title="Bio" value="{{ old('bio', $teamMember->bio) }}" required/>
        <x-text-input2 title="Sort Order" type="number" name="sort_order" type-class="text" value="{{ old('sort_order', $teamMember->sort_order) }}" required/>
        
        <div class="form-group">
            <label>Social Links</label>
            <div id="social-links">
                @php 
                    $socialLinks = old('social_links', $teamMember->social_links ?? []);
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
                                         @if($teamMember->photo)            
                                        <div class="item">
                                            <img id="current-photo" src="{{ asset('storage/uploads/team/'.$teamMember->photo) }}" alt="">
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
let socialIndex = {{ $socialIndex ?? 0 }};

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