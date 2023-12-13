@extends('templates.layout')

@section('title', $menuData['gallery']['label'])

@section('breadcrumb-title', $menuData['gallery']['label'])
@section('breadcrumbs')
    @include('components.dynamic_breadcrumb', ['breadcrumbKey' => 'gallery'])
@endsection

@section('content')
    @include('components._breadcrumb')

<div class="site-wrapper-reveal">
    <div class="gallery-area section-space--pb_120 section-space--pt_90">
        <div class="container">
            @unless (count($data))
            <div class="row">
                <div class="col-12 text-center">
                    <p>Maaf, saat ini belum ada {{ $menuData['gallery']['label'] }} yang tersedia.</p>
                </div>
            </div>
            @else
            <div class="row">
                @foreach ($data as $index => $item)
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-wrap mt-40">
                        <div class="single-gallery-wrap">
                            @if ($item['type'] === 'video')
                            <a href="{{ $item['source'] }}" class="video-link popup-youtube">
                                <img src="{{ $item['image'] }}" class="img-fluid" alt="Service image">
                            </a>
                            @else
                            <a href="{{ $item['image'] }}" class="img-popup">
                                <img src="{{ $item['image'] }}" class="img-fluid"
                                    alt="Gallery Image {{ $index + 1 }}" width="370" height="370">
                            </a>
                            @endif
                        </div>
                        <div class="service-content">
                            {{ Str:: limit($item['description'], 150) }}
                            {{ strlen($item['description']) > 150 ? '...' : '' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endunless
        </div>
    </div>
</div>
@endsection
