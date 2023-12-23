@extends('templates.layout')

@section('title', 'Fasilitas')

@section('breadcrumb-title', $menuData['facility']['label'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'facility'])
@endsection

@section('content')
@include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_facility ?? asset('assets/images/bg/breadcrumb-01.png')])

<div class="site-wrapper-reveal">
    <div class="events-area section-space--pb_120 section-space--pt_90">
        <div class="container">
            @unless (count($data['facility']))
                <div class="row">
                    <div class="col-12 text-center">
                        <p>Maaf, saat ini belum ada {{ $menuData['facility']['label'] }} yang tersedia.</p>
                    </div>
                </div>
            @else
            <div class="row">
                @foreach ($data['facility'] as $facilityItem)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-event-wrap mt-40">
                            <div class="event-image">
                                <img src="{{ $facilityItem['image'] ?? asset('assets/images/events/event-01.png') }}" class="img-fluid" alt="Event Image" style="width: 370px; height: 300px;">
                            </div>
                            <div class="event-content">
                                <div class="content-title">
                                    <h4 class="mb-15">{{ $facilityItem['name'] }}</h4>
                                    <div class="event-date">
                                        <span>{{ \Carbon\Carbon::parse($facilityItem['created_at'])->format('j M Y') }}</span>
                                    </div>
                                    <p>{{ Str::limit($facilityItem['description'], 150) }}</p>
                                </div>
                                <div class="ticket-button-box mt-20">
                                    <a href="{{ route('detail.news', ['type' => $data['slug'], 'slug' => $facilityItem['slug']]) }}" class="btn ticket-btn">Baca Selengkapnya</a>
                                </div>
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
