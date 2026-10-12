@props(['items' => []])

<div {{ $attributes->merge(['class' => 'page-toolbar']) }}>
    <div class="page-toolbar__inner">
        <x-page-breadcrumb :items="$items" />
        @if(isset($actions))
            <div class="page-toolbar__actions">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
