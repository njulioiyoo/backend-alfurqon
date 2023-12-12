<div class="footer-top section-space--ptb_80 section-pb text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="widget-footer mt-30">
                    <div class="footer-title">
                        <h6>Alamat</h6>
                    </div>
                    <div class="footer-contents">
                        {{ $website_contact_info }}
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="widget-footer mt-30">
                    <div class="footer-title">
                        <h6>Menu Terpilih</h6>
                    </div>
                    @php
                        $flatMenuData = Arr::flatten($menuData, 2); // Menggabungkan semua submenu ke dalam satu dimensi
                        $menuWithUrl = Arr::where($flatMenuData, function ($value, $key) {
                            return isset($value['url']) && !empty($value['url']);
                        });
                        $randomMenuItems = Arr::random($menuWithUrl, 3);
                    @endphp

                    <div class="footer-contents">
                        <ul>
                            @foreach($randomMenuItems as $menuItem)
                                <li><a href="{{ $menuItem['url'] }}">{{ $menuItem['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="widget-footer mt-30">
                    <div class="footer-title">
                        <h6>Information</h6>
                    </div>
                    <div class="footer-contents">
                        <ul>
                            <li>Sun Rise: 6:00 am</li>
                            <li>Sun Sat: 5:50 pm</li>
                            <li>Start Time: 9:00 am</li>
                            <li>End Time: 11.00 pm</li>
                            <li>Lunch: 01:30 pm</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="widget-footer mt-30">
                    <div class="footer-title">
                        <h6>Related Links</h6>
                    </div>
                    <div class="footer-logo mb-15">
                        <a href="{{ route('home') }}"><img src="{{ $website_logo_footer }}" alt=""></a>
                    </div>
                    <div class="footer-contents">
                        <p> Subscribe to our Newsletter & stay update. </p>
                        <div class="newsletter-box">
                            <input type="text" placeholder="Enter your mail address">
                            <button><i class="flaticon-paper-plane"></i></button>
                        </div>

                        <ul class="footer-social-share mt-20">
                            <li><a href="#"><i class="flaticon-facebook"></i></a></li>
                            <li><a href="#"><i class="flaticon-twitter"></i></a></li>
                            <li><a href="#"><i class="flaticon-pinterest-social-logo"></i></a></li>
                            <li><a href="#"><i class="flaticon-youtube"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="copy-right-box">
                    <p class="text-white">Copyright &copy; 2020 Hastech <a href="https://hasthemes.com/" target="_blank">All Right Reserved</a>.</p>
                    <p class=" text-white"><a href="#">Privacy policy</a></p>
                </div>
            </div>
        </div>
    </div>
</div>