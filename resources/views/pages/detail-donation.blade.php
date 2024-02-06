@extends('templates.layout')

{{-- @section('title', $data['name']) --}}

@section('content')
@include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_news ?? asset('assets/images/bg/breadcrumb-01.png')])
    <div class="site-wrapper-reveal">
        <!-- ======== Donation Area Start ========== -->
        <div class="donation-area section-space--pb_120 section-space--pt_90">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12">
                        <!-- Single Donation Wrap Start -->
                        <div class="single-donation-wrap row align-items-center">
                            <div class="col-lg-5">
                                <div class="donation-image">
                                    <img src="{{ $data['image'] }}" class="img-fluid" alt="Donation Image">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="donation-content ml-lg-5">
                                    <div class="donation-title mb-30">
                                        <h4 class="mb-15">{{ $data['name'] }}</h4>
                                        <div class="event-date"><span>{{ \Carbon\Carbon::parse($data['created_at'])->format('j M Y') }} </span></div>
                                    </div>

                                    <div class="progress-wrap-muslim">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="progress-bar--two">
                                                    <!-- Start Single Progress Charts -->
                                                    <div class="progress-charts">
                                                        <div class="progress">
                                                            <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>

                                                        <div class="progress_sold_causes">
                                                            <p class="start-sold">Rp.0 terkumpul dari Rp.{{ number_format($data['amount']) }}</p>
                                                        </div>

                                                    </div>
                                                    <!-- End Single Progress Charts -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {!! str_replace('<img', '<img class="img-fluid"', $data['body']) !!}
                                </div>
                            </div>
                        </div>
                        <!--// Single Donation Wrap End -->
                    </div>

                </div>
            </div>
        </div>
        <!-- ======== Donation Area End ========== -->
    </div>
@endsection
