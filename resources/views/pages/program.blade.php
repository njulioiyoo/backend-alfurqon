@extends('templates.layout')

@section('title', 'Program')

@section('breadcrumb-title', $menuData['program']['label'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'program'])
@endsection

@section('content')

@include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_program ?? asset('assets/images/bg/breadcrumb-01.png')])

<div class="site-wrapper-reveal">
    <div class="gallery-area section-space--pb_120 section-space--pt_90">
        <div class="container">
            @unless (count($data['program']))
            <div class="row">
                <div class="col-12 text-center">
                    <p>Maaf, saat ini belum ada {{ $menuData['program']['label'] }} yang tersedia.</p>
                </div>
            </div>
            @else
            <div class="row">
                @foreach ($data['program'] as $index => $item)
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-wrap mt-40">
                        <div class="single-gallery-wrap">
                            @if (!empty($item['source']))
                            <a href="{{ $item['source'] }}" class="video-link popup-youtube">
                                <img src="{{ $item['image'] }}" class="img-fluid" alt="Service image" style="width: 370px; height: 300px;">
                            </a>
                            @else
                            <a href="{{ $item['image'] }}" class="img-popup">
                                <img src="{{ $item['image'] }}" class="img-fluid"
                                    alt="Gallery Image {{ $index + 1 }}" style="width: 370px; height: 300px;">
                            </a>
                            @endif
                        </div>
                        <div class="service-content">
                            {{ Str:: limit($item['description'], 200) }}
                            {{ strlen($item['description']) > 200 ? '...' : '' }}
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
