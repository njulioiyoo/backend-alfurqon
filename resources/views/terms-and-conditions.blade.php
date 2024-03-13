@extends('templates.layout')

@section('title', 'Terms and Conditions')

@section('content')
{{-- @include('components.breadcrumb', ['breadcrumbImage' => $banner_menu_program ?? asset('assets/images/bg/breadcrumb-01.png')]) --}}

<div class="site-wrapper-reveal">
    <div class="church-about-area section-space--ptb_120 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center">
                        <div class="col-lg-11">
                            <div class="donation-content ml-lg-5">
                                @php
                                $descriptionWithResponsiveImg = preg_replace('/<img(.*?)>/i', '<img$1 class="img-fluid">', $terms_conditions);
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
</div>
@endsection