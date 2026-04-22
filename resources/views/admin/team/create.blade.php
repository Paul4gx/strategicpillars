@extends('admin.layouts.app')

@section('content')
<div class="wg-box pl-44 mb-20">
    <h1 class="h3 mb-4 text-gray-800">Add Team Member</h1>
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="form-bacsic-infomation flex gap30 flex-column">
        @csrf
 
                <x-text-input2 title="Name" type="text" name="name" type-class="text" required/>
                <x-text-input2 title="Role/Title" type="text" name="role" type-class="text" required/>
                <x-text-input2 title="Email" type="email" name="email" type-class="text" value="{{ old('email') }}" required/>
                <fieldset class="border rounded p-15 mb-15" style="border-color: #dee2e6;">
                    <label class="d-flex align-items-start gap10 cursor-pointer mb-0">
                        <input type="checkbox" name="create_property_account" value="1" class="mt-5" @checked(old('create_property_account'))>
                        <span>
                            <strong>Create realtor login for this person</strong>
                            <span class="d-block text-muted small mt-5">When checked, we create an account with permission to add and manage their own listings in the realtor portal. They receive an email to set a password, then complete their public profile (realty name, photo, etc.). Leave unchecked for website-only profiles (e.g. staff shown on the team page without listing access).</span>
                        </span>
                    </label>
                </fieldset>
                <x-text-input2 title="Phone" type="tel" name="phone" type-class="text" required/>
                <x-textarea2 name="bio" title="Bio" required/>
                <x-text-input2 title="Sort Order" type="number" name="sort_order" type-class="text" required/>
                <div class="form-group">
    <label>Social Links</label>
    <div id="social-links">

        {{-- Facebook --}}
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

        {{-- Instagram --}}
        <div class="input-group mb-2">
            <select name="social_links[1][platform]" class="form-control" style="max-width: 150px;">
                <option value="facebook">Facebook</option>
                <option value="instagram" selected>Instagram</option>
                <option value="twitter">Twitter</option>
                <option value="linkedin">LinkedIn</option>
                <option value="youtube">YouTube</option>
            </select>
            <input type="text" name="social_links[1][username]" class="form-control" placeholder="username">
            <div class="input-group-append">
                <button class="btn btn-danger remove-social" type="button">&times;</button>
            </div>
        </div>

        {{-- Twitter --}}
        <div class="input-group mb-2">
            <select name="social_links[2][platform]" class="form-control" style="max-width: 150px;">
                <option value="facebook">Facebook</option>
                <option value="instagram">Instagram</option>
                <option value="twitter" selected>Twitter</option>
                <option value="linkedin">LinkedIn</option>
                <option value="youtube">YouTube</option>
            </select>
            <input type="text" name="social_links[2][username]" class="form-control" placeholder="username">
            <div class="input-group-append">
                <button class="btn btn-danger remove-social" type="button">&times;</button>
            </div>
        </div>

    </div>
    <button type="button" class="btn btn-secondary" id="add-social">Add Social Link</button>
</div>



                <div class="form-group">
                    <label for="photo">Profile Photo</label>
                    <input type="file" name="photo" class="form-control-file">
                </div>

        <button type="submit" class="tf-button-primary">Save Team Member</button>
    </form>
</div>
@endsection 
@push('scripts')
<script>
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