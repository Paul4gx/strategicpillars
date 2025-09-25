@props([
    'title',
    'type' => 'text',
    'typeClass' => '',
    'name',
    'value' => null
])

<fieldset class="{{ $typeClass }} has-top-title">
    <input 
        type="{{ $type }}"  
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $title }}" 
        tabindex="2" 
        aria-required="true"  
        value="{{ old($name, $value) }}" 
        {{ $attributes->merge(['class' => '']) }}
    >
    <label for="{{$name}}">{{ $title }}</label>
    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</fieldset>

