@props([
    'items' => [],
    'variant' => 'default',
])

@php
    $items = array_values($items);
@endphp

@if(count($items) > 0)
<nav {{ $attributes->merge(['class' => 'page-breadcrumb page-breadcrumb--'.$variant]) }} aria-label="Breadcrumb">
    <ol class="page-breadcrumb__list">
        @foreach($items as $index => $item)
            @php
                $label = $item['label'] ?? '';
                $url = $item['url'] ?? null;
                $isLast = $index === count($items) - 1;
            @endphp
            <li class="page-breadcrumb__item @if($isLast) is-current @endif">
                @if(! $isLast && filled($url))
                    <a href="{{ $url }}">{{ $label }}</a>
                @else
                    <span @if($isLast) aria-current="page" @endif>{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif

@once
    @push('styles')
    <style>
    .page-breadcrumb__list {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0;
        font-size: 13px;
        line-height: 1.35;
    }

    .page-breadcrumb-band,
    .page-toolbar {
        background: linear-gradient(180deg, #183a34 0%, var(--Fourth, #1f4b43) 100%);
    }

    .page-breadcrumb-band {
        padding: 11px 0;
    }

    .page-breadcrumb__item {
        display: inline-flex;
        align-items: center;
        max-width: 100%;
        color: rgba(255, 255, 255, 0.72);
    }

    .page-breadcrumb:not(.page-breadcrumb--light) .page-breadcrumb__item:not(:last-child)::after {
        content: "";
        display: inline-block;
        width: 4px;
        height: 4px;
        margin: 0 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.42);
        flex-shrink: 0;
    }

    .page-breadcrumb:not(.page-breadcrumb--light) .page-breadcrumb__item a {
        color: rgba(255, 255, 255, 0.92);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s ease;
    }

    .page-breadcrumb:not(.page-breadcrumb--light) .page-breadcrumb__item a:hover {
        color: var(--Primary, #e7c873);
    }

    .page-breadcrumb:not(.page-breadcrumb--light) .page-breadcrumb__item.is-current span {
        color: var(--Primary, #e7c873);
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: min(420px, 55vw);
    }

    .page-breadcrumb--light .page-breadcrumb__item {
        color: rgba(255, 255, 255, 0.75);
    }

    .page-breadcrumb--light .page-breadcrumb__item:not(:last-child)::after {
        content: "";
        display: inline-block;
        width: 4px;
        height: 4px;
        margin: 0 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.45);
        flex-shrink: 0;
    }

    .page-breadcrumb--light .page-breadcrumb__item a {
        color: rgba(255, 255, 255, 0.88);
        text-decoration: none;
        font-weight: 500;
    }

    .page-breadcrumb--light .page-breadcrumb__item a:hover {
        color: var(--Primary, #e7c873);
    }

    .page-breadcrumb--light .page-breadcrumb__item.is-current span {
        color: var(--Primary, #e7c873);
        font-weight: 600;
    }

    .page-toolbar {
        padding: 12px 16px;
        margin-bottom: 16px;
        border-radius: 12px;
        border-bottom: none;
    }

    .page-toolbar__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .page-toolbar__actions {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .page-toolbar__actions .list-icons-page {
        padding-top: 0;
    }

    .page-toolbar .list-icons-page .item p {
        color: rgba(255, 255, 255, 0.88);
    }

    .page-toolbar .listing-share-btn .icon {
        background-color: rgba(255, 255, 255, 0.12);
    }

    .page-toolbar .listing-share-btn .icon i {
        color: #fff;
    }

    .page-header {
        padding: 0;
        text-align: center;
        background: #fff;
        border-bottom: 1px solid rgba(31, 75, 67, 0.1);
        margin-bottom: 28px;
        overflow: hidden;
    }

    .page-header__body {
        padding: 20px 0 26px;
    }

    .page-header--left {
        text-align: left;
    }

    .page-header--left .page-breadcrumb__list {
        justify-content: flex-start;
    }

    .page-breadcrumb-band .page-breadcrumb {
        display: flex;
        justify-content: center;
    }

    .page-header--left .page-breadcrumb-band .page-breadcrumb {
        justify-content: flex-start;
    }

    .page-header__title {
        margin: 0 0 6px;
        font-size: clamp(1.45rem, 3.5vw, 2rem);
        font-weight: 600;
        line-height: 1.25;
        color: #212529;
    }

    .page-header__subtitle {
        margin: 0 auto;
        max-width: 640px;
        font-size: 16px;
        line-height: 1.5;
        color: #6c757d;
    }

    .page-header--left .page-header__subtitle {
        margin-left: 0;
        margin-right: 0;
    }

    .flat-title.inner-page .content .page-breadcrumb {
        display: flex;
        justify-content: center;
        margin-bottom: 14px;
    }

    .interior-show-section {
        padding-top: 48px !important;
        padding-bottom: 80px !important;
    }

    @media (max-width: 768px) {
        .page-toolbar {
            padding: 10px 14px;
            margin-bottom: 12px;
            border-radius: 10px;
        }

        .page-header__body {
            padding: 16px 0 20px;
        }

        .page-toolbar__inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-toolbar__actions {
            width: 100%;
            justify-content: flex-end;
        }

        .page-header {
            padding: 14px 0 20px;
            margin-bottom: 20px;
        }

        .page-breadcrumb__item.is-current span {
            max-width: 100%;
            white-space: normal;
        }
    }
    </style>
    @endpush
@endonce
