@extends('templates.layout')

@section('title', $menuData['gallery']['label'])

{{-- @section('breadcrumb-title', $menuData['gallery']['label'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'gallery'])
@endsection --}}

@section('content')
    @include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_gallery ?? asset('assets/images/bg/breadcrumb-01.png')])

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
                             <a href="#" data-toggle="modal" data-target="#mediaModal{{ $index }}">
                                <img src="{{ $item['image'] }}" class="img-fluid" alt="{{ !empty($item['source']) ? 'Video Gambar' : 'Galeri Gambar' . ($index + 1) }}" style="width: 370px; height: 200px;">
                            </a>

                            <!-- Media Modal -->
                            <div class="modal fade" id="mediaModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel{{ $index }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mediaModalLabel{{ $index }}">{{ !empty($item['source']) ? 'Video' : 'Galeri' }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if ($item['type'] === 'video')
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="{{ str_replace('watch?v=', 'embed/', $item['source']) }}" allowfullscreen></iframe>
                                                </div>
                                            @else
                                                <img src="{{ $item['image'] }}" class="img-fluid mx-auto my-auto" alt="{{ !empty($item['source']) ? 'Video Gambar' : 'Galeri Gambar' . ($index + 1) }}" style="max-width: 100%; max-height: 100%;">
                                            @endif
                                            <p>{{ $item['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
