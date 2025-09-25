@props([
    'title',
    'typeClass' => 'description',
    'name',
    'value' => null
])
<fieldset class="{{ $typeClass }} has-top-title">
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $title }}" 
        tabindex="2" 
        aria-required="true"   
        {{ $attributes->merge(['class' => '']) }}>{{ old($name, $value) }}</textarea>
    <label for="{{ $name }}">{{ $title }}</label>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</fieldset>

