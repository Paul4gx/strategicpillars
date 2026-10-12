@props([
    'title',
    'subtitle' => null,
    'items' => [],
    'align' => 'center',
])

<section {{ $attributes->merge(['class' => 'page-header page-header--'.$align]) }}>
    @if(count($items) > 0)
        <div class="page-breadcrumb-band">
            <div class="cl-container full">
                <x-page-breadcrumb :items="$items" />
            </div>
        </div>
    @endif
    <div class="cl-container full page-header__body">
        <h1 class="page-header__title">{{ $title }}</h1>
        @if(filled($subtitle))
            <p class="page-header__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
</section>
