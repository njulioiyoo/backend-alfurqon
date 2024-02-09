@extends('templates.layout')

@section('title', $data['name'])

{{-- @section('breadcrumb-title', $data['name'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'facility'])
@endsection --}}

@section('content')
@include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_program ?? asset('assets/images/bg/breadcrumb-01.png')])

<div class="site-wrapper-reveal">
    <div class="church-about-area section-space--ptb_120 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center">
                        <div class="col-lg-11">
                            <div class="donation-content ml-lg-5">
                                <div class="donation-title mb-30">
                                    <h4 class="mb-15">{{ $data['name'] }}</h4>
                                    <div class="event-date">
                                        <span>{{ \Carbon\Carbon::parse($data['created_at'])->format('j M Y') }}</span>
                                    </div>
                                </div>

                                @php
                                $descriptionWithResponsiveImg = preg_replace('/<img(.*?)>/i', '<img$1 class="img-fluid">', $data['body']);
                                        @endphp

                                        {!! $descriptionWithResponsiveImg !!}

                            </div>
                        </div>
                    </div>
                    <!--// Single Donation Wrap End -->
                </div>

            </div>
        </div>
    </div>

    <!-- ======== Ticket Area Start ========== -->
    @if(!empty($data['donation']))
    <div class="ticket-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter-box-area newsletter-bg" style="background: url({{ $data['donation']['banner'] }})">
                        <div class="newsletter-title">&nbsp;</div>
                        <a href="{{ route('detail.donation', ['slug' => $data['donation']['slug']]) }}" class="btn single-by-ticket-btn" style="background: #f3b263;">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- ======== Ticket  Area End ========== -->
</div>
@endsection