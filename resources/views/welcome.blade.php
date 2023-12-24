@extends('templates.layout')

@section('title', 'Home')

@section('content')
<div class="site-wrapper-reveal no-overflow">
    <!-- ======== Hero Area Start ========== -->
    <div class="muslim-hero-color">
        <div class="muslim-hero-wrap">
            <div class="hero-area hero-style-02 muslim-hero-bg bg-overlay-black" style="background-image: url('{{ $main_banner }}');"></div>
        </div>
    </div>
    <!-- ======== Hero Area End ========== -->
    <div class="muslim-salte-time">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="salat-content" id="prayerTimesContainer"></div>
                </div>
            </div>
        </div>

        <div class="muslim-salat-time-bg"></div>
    </div>
    <!-- ======== Tai About Area Start ========== -->
    <div class="tai-about-area section-space--ptb_120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="about-muslim-image text-lg-left">
                        <img src="{{ $main_picture_about ?? '' }}" class="img-fluid muslim-image-1" alt="Tai Images">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-tai-content small-mt__30 tablet-mt__30">
                        <div class="section-title-muslim text-left">
                            <h3 class="mb-20">{{ $website_name ?? '' }}</h3>
                        </div>
                        <p>{{ $website_description ?? '' }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ======== Tai About Area End ========== -->
    @if(!empty($data['service']))
    <!-- ======== Service Area Start ========== -->
    <div class="service-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-muslim text-center">
                        <h3 class="mb-20">Program Pilihan</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($data['service'] as $index => $item)
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-wrap mt-30">
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
                            <h4 class="service-title">{{ $item['title'] }}</h4>
                            {{ Str:: limit($item['content'], 200) }}
                            {{ strlen($item['content']) > 200 ? '...' : '' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ======== Service Area End ========== -->
    @endif
    <!-- ======== Donation Area Start ========== -->
    <div class="donation-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-muslim text-center">
                        <h3 class="mb-20">Bantuan Keagamaan Kami</h3>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center">
                        <div class="col-lg-5">
                            <div class="donation-image">
                                <img src="assets/images/donation/pembangunan-masjid.jpeg" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="donation-content ml-lg-5">
                                <div class="content-title">
                                    <h4 class="mb-15">Donasi Pembangunan Masjid Al-Furqon Bekasi Barat</h4>
                                    <p>Masjid Al-Furqon di Bekasi Barat memulai proyek pembangunan yang ambisius untuk memperluas dan meningkatkan fasilitasnya, dengan tujuan memberikan pelayanan yang lebih baik kepada umat dan memperkuat ikatan komunitas. Donasi Anda akan membantu mewujudkan visi ini dan memberikan kontribusi positif terhadap kehidupan keagamaan di daerah ini.</p>
                                </div>

                                <div class="progress-wrap-muslim">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="progress-bar--two">
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            <p class="percent-label">0</p>
                                                        </div>
                                                    </div>

                                                    <div class="progress_sold_av">
                                                        <p class="start-sold">0</p>
                                                        <p class="sold-av">30.000.000 <br> <span>OUR GOAL</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="donate-btn text-lg-right">
                                                <a href="#" class="btn donate-btn">Donasi Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--// Single Donation Wrap End -->
                </div>

                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center">
                        <div class="col-lg-5">
                            <div class="donation-image">
                                <img src="assets/images/donation/santunan-yatim.jpeg" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="donation-content ml-lg-5">
                                <div class="content-title">
                                    <h4 class="mb-15">Donasi untuk Anak Yatim: Memberikan Harapan dan Pemulihan</h4>
                                    <p>Donasi untuk anak yatim adalah cara luar biasa untuk memberikan dampak positif pada kehidupan anak-anak yang kehilangan satu atau kedua orang tua mereka. Inisiatif ini memberikan dukungan finansial dan emosional kepada anak yatim, membantu mereka membangun masa depan yang lebih baik dan menanggulangi kesulitan hidup yang mereka hadapi.</p>
                                </div>

                                <div class="progress-wrap-muslim">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="progress-bar--two">
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            <p class="percent-label">0</p>
                                                        </div>
                                                    </div>

                                                    <div class="progress_sold_av">
                                                        <p class="start-sold">0</p>
                                                        <p class="sold-av">10.000.000 <br> <span>OUR GOAL</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="donate-btn text-lg-right">
                                                <a href="#" class="btn donate-btn">Donasi Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--// Single Donation Wrap End -->
                </div>

                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center">
                        <div class="col-lg-5">
                            <div class="donation-image">
                                <img src="assets/images/donation/sedekah.jpeg" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="donation-content ml-lg-5">
                                <div class="content-title">
                                    <h4 class="mb-15">Sedekah: Memberikan Kebaikan yang Menyentuh Hati</h4>
                                    <p>Sedekah merupakan tindakan mulia memberikan sebagian dari harta atau sumber daya kita kepada mereka yang membutuhkan, tanpa mengharapkan imbalan atau balasan. Ini adalah amal perbuatan yang memiliki dampak positif pada individu dan komunitas secara keseluruhan</p>
                                </div>

                                <div class="progress-wrap-muslim">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="progress-bar--two">
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            <p class="percent-label">0</p>
                                                        </div>
                                                    </div>

                                                    <div class="progress_sold_av">
                                                        <p class="start-sold">0</p>
                                                        <p class="sold-av">10.000.000 <br> <span>OUR GOAL</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="donate-btn text-lg-right">
                                                <a href="#" class="btn donate-btn">Donasi Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--// Single Donation Wrap End -->
                </div>


            </div>
        </div>
    </div>
    <!-- ======== Donation Area End ========== -->
    @if(!empty($data['others_activities']))
    <!-- ======== Others Activities Area Start ========== -->
    <div class="others-activities-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center">
                        <h3 class="section-title center-style">Berita Utama</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($data['others_activities'] as $item)    
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="#" class="activities-imgaes">
                            <img src="{{ $item['image'] }}" class="img-fluid" alt="">
                        </a>
                        <div class="activities-content text-center">
                            <div class="widget-metadata"><span>{{ $item['time'] }}</span></div>
                            <a href="{{ route('detail.news', ['type' => $item['news_type'], 'slug' => $item['slug']]) }}">
                                <h4 class="activities-title">{{ $item['title'] }}</h4>
                            </a>
                            <p>{{ Str::limit($item['content'], 150) }}</p>
                            <div class="ticket-button-box mt-20">
                                <a href="{{ route('detail.news', ['type' => $item['news_type'], 'slug' => $item['slug']]) }}" class="btn ticket-btn">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ======== Others Activities Area End ========== -->
    @endif
</div>
@endsection