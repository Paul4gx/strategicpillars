@extends('layouts.app')

@section('title', 'Interior Project | Strategic Pillars')
@section('meta_description', 'Interior design project showcase from Strategic Pillars.')

@section('content')
<section class="tf-section interior-show-section">
    <div class="cl-container">
        <x-page-toolbar :items="[
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Interiors', 'url' => route('interiors.index')],
            ['label' => $interior?->title ?? 'Project'],
        ]" class="mb-4" />
        <div class="row">
            <div class="col-12">
                <div class="heading-section">
                    <h1 class="wow fadeInUp">{{ $interior->title ?? 'Interior showcase' }}</h1>
                    <div class="text-content wow fadeInUp">
                        @if($interior)
                            {!! nl2br(e($interior->description ?? '')) !!}
                        @else
                            This project page is being prepared. Browse our interior design services and featured work on the main interiors page.
                        @endif
                    </div>
                    <a href="{{ route('interiors.index') }}" class="tf-button-primary wow fadeInUp mt-20">Back to interiors</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
