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
                        <h6>Informasi Waktu Shalat</h6>
                    </div>
                    <div class="footer-contents">
                        <ul id="prayerTimesInfoContainer"></ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="widget-footer mt-30">
                    <div class="footer-title">
                        <h6>Related Links</h6>
                    </div>
                    <div class="footer-contents">
                        <ul>
                            <li><a href="{{ route('terms-and-conditions') }}">Syarat dan Ketentuan</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div class="footer-logo mb-15">
                        <a href="{{ route('home') }}"><img src="{{ $website_logo_footer }}" alt=""></a>
                    </div>
                    <div class="footer-contents">

                        <ul class="footer-social-share mt-20">
                            <li><a href="{{ $facebook ?? route('home') }}"><i class="flaticon-facebook"></i></a></li>
                            <li><a href="{{ $instagram ?? route('home') }}"><i class="flaticon-twitter"></i></a></li>
                            <li><a href="{{ $youtube ?? route('home') }}" target="_blank"><i class="flaticon-youtube"></i></a></li>
                            <li><a href="{{ $whatsapp ?? route('home') }}" target="_blank"><i class="flaticon-whatsapp"></i></a></li>
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
                    <p class="text-white">Hak Cipta © {{ config('app.name') }} {{ date('Y') }}. Semua hak dilindungi. Tidak ada bagian dari situs web ini yang boleh direproduksi, didistribusikan, atau ditransmisikan dalam bentuk apa pun atau dengan cara apa pun tanpa izin tertulis sebelumnya dari {{ config('app.name') }}.</p>
                </div>
            </div>
        </div>
    </div>
</div>