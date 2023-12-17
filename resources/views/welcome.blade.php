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
                        <img src="assets/images/banners/kaaba.png" class="img-fluid muslim-image-1" alt="Tai Images">

                        <img src="assets/images/banners/kaaba-bottom-01.png" class="img-fluid bottom-image-2" alt="Tai Images">
                        <img src="assets/images/banners/kaaba-bottom-02.png" class="img-fluid bottom-image-3" alt="Tai Images">

                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-tai-content small-mt__30 tablet-mt__30">
                        <div class="section-title-muslim text-left">
                            <h3 class="mb-20">Kaaba Sharif</h3>
                        </div>
                        <p>It is a long established fact that a reader will be distracted by
                            the readable content of a page when looking at its layout.
                            The point of using Lorem Ipsum is that it has a more-or-less normal
                            distribution of letters.</p>
                        <div class="btn">
                            <a href="#">Button</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ======== Tai About Area End ========== -->
    <!-- ======== Foundation Area Start ========== -->
    <div class="foundation-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-muslim text-center">
                        <h3 class="mb-20">Mosque Foundation</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Foundation Start -->
                    <div class="single-foundation">
                        <div class="foundation-image">
                            <a href="#"><img src="assets/images/foundation/mosque-fondation-01.png" class="img-fluid" alt=""></a>
                        </div>
                        <div class="foundation-content">
                            <div class="location">
                                <a href="#">
                                    <h5>UAE adu Mosque</h5>
                                </a>
                                <a href="#" class="foundation-loction">Abu Dhabi, United Arab Emirates</a>
                            </div>
                        </div>
                    </div>
                    <!--// Foundation End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Foundation Start -->
                    <div class="single-foundation">
                        <div class="foundation-image">
                            <a href="#"><img src="assets/images/foundation/mosque-fondation-02.png" class="img-fluid" alt=""></a>
                        </div>
                        <div class="foundation-content">
                            <div class="location">
                                <a href="#">
                                    <h5>UAE adu Mosque</h5>
                                </a>
                                <a href="#" class="foundation-loction">Abu Dhabi, United Arab Emirates</a>
                            </div>
                        </div>
                    </div>
                    <!--// Foundation End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Foundation Start -->
                    <div class="single-foundation">
                        <div class="foundation-image">
                            <a href="#"><img src="assets/images/foundation/mosque-fondation-03.png" class="img-fluid" alt=""></a>
                        </div>
                        <div class="foundation-content">
                            <div class="location">
                                <a href="#">
                                    <h5>UAE adu Mosque</h5>
                                </a>
                                <a href="#" class="foundation-loction">Abu Dhabi, United Arab Emirates</a>
                            </div>
                        </div>
                    </div>
                    <!--// Foundation End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Foundation Start -->
                    <div class="single-foundation">
                        <div class="foundation-image">
                            <a href="#"><img src="assets/images/foundation/mosque-fondation-04.png" class="img-fluid" alt=""></a>
                        </div>
                        <div class="foundation-content">
                            <div class="location">
                                <a href="#">
                                    <h5>UAE adu Mosque</h5>
                                </a>
                                <a href="#" class="foundation-loction">Abu Dhabi, United Arab Emirates</a>
                            </div>
                        </div>
                    </div>
                    <!--// Foundation End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Foundation Start -->
                    <div class="single-foundation">
                        <div class="foundation-image">
                            <a href="#"><img src="assets/images/foundation/mosque-fondation-05.png" class="img-fluid" alt=""></a>
                        </div>
                        <div class="foundation-content">
                            <div class="location">
                                <a href="#">
                                    <h5>UAE adu Mosque</h5>
                                </a>
                                <a href="#" class="foundation-loction">Abu Dhabi, United Arab Emirates</a>
                            </div>
                        </div>
                    </div>
                    <!--// Foundation End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Foundation Start -->
                    <div class="single-foundation">
                        <div class="foundation-image">
                            <a href="#"><img src="assets/images/foundation/mosque-fondation-06.png" class="img-fluid" alt=""></a>
                        </div>
                        <div class="foundation-content">
                            <div class="location">
                                <a href="#">
                                    <h5>UAE adu Mosque</h5>
                                </a>
                                <a href="#" class="foundation-loction">Abu Dhabi, United Arab Emirates</a>
                            </div>
                        </div>
                    </div>
                    <!--// Foundation End -->
                </div>
            </div>
        </div>
    </div>
    <!-- ======== Foundation Area End ========== -->
    <!-- ======== Service Area Start ========== -->
    <div class="service-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-muslim text-center">
                        <h3 class="mb-20">What we do</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service Start -->
                    <div class="single-service-wrap mt-30">
                        <div class="service-image">
                            <a href="#"><img src="assets/images/services/muslim-service-01.png" class="img-fluid" alt="Service image"></a>
                        </div>
                        <div class="service-content">
                            <h4 class="service-title"><a href="#">Islamic Prayer</a></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been standard dummy text.</p>
                        </div>
                    </div>
                    <!--// Single Service End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service Start -->
                    <div class="single-service-wrap mt-30">
                        <div class="service-image">
                            <a href="#"><img src="assets/images/services/muslim-service-02.png" class="img-fluid" alt="Service image"></a>
                        </div>
                        <div class="service-content">
                            <h4 class="service-title"><a href="#">Child Quran Learning</a></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been standard dummy text.</p>
                        </div>
                    </div>
                    <!--// Single Service End -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Service Start -->
                    <div class="single-service-wrap mt-30">
                        <div class="service-image">
                            <a href="#"><img src="assets/images/services/muslim-service-03.png" class="img-fluid" alt="Service image"></a>
                        </div>
                        <div class="service-content">
                            <h4 class="service-title"><a href="#">Quran Tilawat</a></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been standard dummy text.</p>
                        </div>
                    </div>
                    <!--// Single Service End -->
                </div>
            </div>
        </div>
    </div>
    <!-- ======== Service Area End ========== -->
    <!-- ======== Donation Area Start ========== -->
    <div class="donation-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-muslim text-center">
                        <h3 class="mb-20">Donation Form Our Temple</h3>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <!-- Single Donation Wrap Start -->
                    <div class="single-donation-wrap row align-items-center">
                        <div class="col-lg-5">
                            <div class="donation-image">
                                <img src="assets/images/donation/muslim-donate-01.png" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="donation-content ml-lg-5">
                                <div class="content-title">
                                    <h4 class="mb-15">Education for all rural children.</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Ipsum has been standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>

                                <div class="progress-wrap-muslim">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="progress-bar--two">
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            <p class="percent-label">$4500.00</p>
                                                        </div>
                                                    </div>

                                                    <div class="progress_sold_av">
                                                        <p class="start-sold">$00.00</p>
                                                        <p class="sold-av">$8500.00 <br> <span>OUR GOAL</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="donate-btn text-lg-right">
                                                <a href="#" class="btn donate-btn">Donate Now</a>
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
                                <img src="assets/images/donation/muslim-donate-02.png" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="donation-content ml-lg-5">
                                <div class="content-title">
                                    <h4 class="mb-15">Reconstruct or new construct Temple</h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Ipsum has been standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>

                                <div class="progress-wrap-muslim">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="progress-bar--two">
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            <p class="percent-label">$4500.00</p>
                                                        </div>
                                                    </div>

                                                    <div class="progress_sold_av">
                                                        <p class="start-sold">$00.00</p>
                                                        <p class="sold-av">$8500.00 <br> <span>OUR GOAL</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="donate-btn text-lg-right">
                                                <a href="#" class="btn donate-btn">Donate Now</a>
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
                                <img src="assets/images/donation/muslim-donate-03.png" class="img-fluid" alt="Donation Image">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="donation-content ml-lg-5">
                                <div class="content-title">
                                    <h4 class="mb-15">Ensure child safety & health </h4>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Ipsum has been standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>

                                <div class="progress-wrap-muslim">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="progress-bar--two">
                                                <!-- Start Single Progress Charts -->
                                                <div class="progress-charts">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay=".3s" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                            <p class="percent-label">$4500.00</p>
                                                        </div>
                                                    </div>

                                                    <div class="progress_sold_av">
                                                        <p class="start-sold">$00.00</p>
                                                        <p class="sold-av">$8500.00 <br> <span>OUR GOAL</span></p>
                                                    </div>
                                                </div>
                                                <!-- End Single Progress Charts -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="donate-btn text-lg-right">
                                                <a href="#" class="btn donate-btn">Donate Now</a>
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
    <!-- ======== Others Activities Area Start ========== -->
    <div class="others-activities-area section-space--pb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center">
                        <h3 class="section-title center-style">Others Activities</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="#" class="activities-imgaes">
                            <img src="assets/images/activities/muslim-activities-01.png" class="img-fluid" alt="">
                        </a>
                        <div class="activities-content text-center">
                            <div class="widget-metadata"><span>Time : 09:30 am to 12:00 pm</span></div>
                            <a href="#">
                                <h4 class="activities-title">Support pour & rural people</h4>
                            </a>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="#" class="activities-imgaes">
                            <img src="assets/images/activities/muslim-activities-02.png" class="img-fluid" alt="">
                        </a>
                        <div class="activities-content text-center">
                            <div class="widget-metadata"><span>Time : 10:40 am to 12:00 pm</span></div>
                            <a href="#">
                                <h4 class="activities-title">Make Mosque & Prayer place.</h4>
                            </a>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Activities Start -->
                    <div class="single-activities-wrap">
                        <a href="#" class="activities-imgaes">
                            <img src="assets/images/activities/muslim-activities-03.png" class="img-fluid" alt="">
                        </a>
                        <div class="activities-content text-center">
                            <div class="widget-metadata"><span>Time : 11:30 am to 12:00 pm</span></div>
                            <a href="#">
                                <h4 class="activities-title">Islamic activities for children.</h4>
                            </a>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>
                    <!--// Single Activities End -->
                </div>
            </div>
        </div>
    </div>
    <!-- ======== Others Activities Area End ========== -->
</div>
@endsection

@push('extend-scripts')
{{-- <script text="type/javascript">
    // Fungsi untuk mendapatkan waktu shalat dari API Aladhan
    function getPrayerTimes(latitude, longitude) {
        var xhr = new XMLHttpRequest();
        var apiUrl = 'http://api.aladhan.com/v1/calendar?latitude=' + latitude + '&longitude=' + longitude + '&method=2';

        xhr.open('GET', apiUrl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                var prayerTimes = responseData.data[0].timings;

                var salatNames = {
                    'Fajr': 'fajr-icon.png',
                    'Dhuhr': 'dhuhr-icon.png',
                    'Asr': 'asr-icon.png',
                    'Maghrib': 'maghrib-icon.png',
                    'Isha': 'isha-icon.png'
                };

                var formattedPrayerTimes = [];

                for (var salatName in salatNames) {
                    if (salatNames.hasOwnProperty(salatName)) {
                        formattedPrayerTimes.push({
                            'name': salatName,
                            'icon': salatNames[salatName],
                            'time': prayerTimes[salatName] ?? null
                        });
                    }
                }
                displayPrayerTimes(formattedPrayerTimes);
            }
        };

        xhr.send();
    }

    // Fungsi untuk menampilkan waktu salat dalam format HTML
    function displayPrayerTimesCopy(prayerTimes) {
        var container = document.getElementById('prayerTimesContainer');
        container.innerHTML = ''; // Menghapus konten sebelumnya

        prayerTimes.forEach(function (prayerTime) {
            var html = `
                <div class="single-salat-time">
                    <div class="img"><img src="assets/images/icons/${prayerTime.icon}" alt="${prayerTime.name}"></div>
                    <div class="salat-times__box">
                        <h4>${prayerTime.name}</h4><span>${prayerTime.time}</span>
                    </div>
                </div>
            `;
            container.innerHTML += html;
        });
    }

    // Fungsi untuk menampilkan waktu salat dalam format HTML
    function displayPrayerTimes(prayerTimes) {
        var container = document.getElementById('prayerTimesContainer');
        var infoContainer = document.getElementById('prayerTimesInfoContainer');
        
        container.innerHTML = ''; // Menghapus konten sebelumnya
        infoContainer.innerHTML = ''; // Menghapus konten sebelumnya

        prayerTimes.forEach(function (prayerTime) {
            // Tambahkan elemen HTML ke container waktu salat
            var html = `
                <div class="single-salat-time">
                    <div class="img"><img src="assets/images/icons/${prayerTime.icon}" alt="${prayerTime.name}"></div>
                    <div class="salat-times__box">
                        <h4>${prayerTime.name}</h4><span>${prayerTime.time}</span>
                    </div>
                </div>
            `;
            container.innerHTML += html;

            // Tambahkan informasi waktu salat ke container informasi
            var infoHtml = `<li>${prayerTime.name}: ${prayerTime.time}</li>`;
            infoContainer.innerHTML += infoHtml;
        });
    }

    function getLatitudeAndLongitude() {
        var xhr = new XMLHttpRequest();
        var ipApiUrl = 'https://ipapi.co/json/';

        xhr.open('GET', ipApiUrl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                var latitude = responseData.latitude;
                var longitude = responseData.longitude;

                getPrayerTimes(latitude, longitude);
            }
        };

        xhr.send();
    }

    getLatitudeAndLongitude();
</script> --}}
@endpush