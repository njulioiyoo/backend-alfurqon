@extends('templates.layout')

@section('title', $menuData['about']['label'])

@section('breadcrumb-title', $menuData['about']['label'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'about'])
@endsection

@section('content')
@include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_about ?? asset('assets/images/bg/breadcrumb-01.png')])

<div class="site-wrapper-reveal">
    <div class="church-about-area section-space--ptb_120 ">
        <div class="container">
            <div class="row align-items-center">
                @unless(empty($data['banner']))
                <div class="{{ $data['banner'] ? 'col-lg-5' : 'col-lg-12' }}">
                    <div class="about-tai-image small-mb__30 tablet-mb__30">
                        <img src="{{ $data['banner'] }}" class="img-fluid" alt="{{ $data['name'] }}">
                    </div>
                </div>
                @endunless
                <div class="{{ $data['banner'] ? 'col-lg-7' : 'col-lg-12' }}">
                    <div class="about-tai-content">
                        <div class="section-title-wrap">
                            <h3 class="section-title--two left-style mb-30">{{ $data['name'] }}</h3>
                        </div>
                        @php
                            $descriptionWithResponsiveImg = preg_replace('/<img(.*?)>/i', '<img$1 class="img-fluid">', $data['description']);
                        @endphp
                        
                        {!! $descriptionWithResponsiveImg !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @unless(empty($data['youtube_url']))
    <div class="about-video-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title-wrap text-center section-space--mb_40">
                        <h3 class="section-title--two  center-style mb-30">{{ $data['name'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="about-video-box about-video-bg">
                <div class="col-lg-6 ml-auto mr-auto">
                    <div class="video-content-wrap text-center">
                        <div class="icon">
                            <a href="{{ $data['youtube_url'] }}" class="video-link popup-youtube">
                                <img src="{{ asset('assets/images/icons/play-circle.png') }}" alt="Video Icon">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endunless
</div>
@endsection
