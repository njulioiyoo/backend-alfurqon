@extends('templates.layout')

@section('title', $data['name'])

{{-- @section('breadcrumb-title', $data['name'])
@section('breadcrumbs')
    @include('components.dynamic-breadcrumb', ['breadcrumbKey' => 'facility'])
@endsection --}}

@section('content')
@include('components.breadcrumb')

<div class="site-wrapper-reveal">
    <div class="donation-area section-space--pb_120 section-space--pt_90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-donation-wrap row align-items-center">
                        @if(isset($data['image']))
                            <div class="col-lg-5">
                                <div class="donation-image">
                                    <img src="{{ $data['image'] }}" class="img-fluid" alt="Donation Image">
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-{{ isset($data['image']) ? '6' : '11' }}">
                            <div class="donation-content ml-lg-{{ isset($data['image']) ? '5' : '0' }}">
                                <div class="donation-title mb-30">
                                    <h4 class="mb-15">{{ $data['name'] }}</h4>
                                    <div class="event-date"><span>{{ \Carbon\Carbon::parse($data['created_at'])->format('j M Y') }}</span></div>
                                </div>
                                {!! $data['body'] !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
