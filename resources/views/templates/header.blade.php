<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-center">
            <div class="header__logo">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ $website_logo_header ?? '' }}" alt=""></a>
                </div>
            </div>
            <div class="header-right">
                <div class="header__navigation menu-style-three d-none d-lg-block">
                    <nav class="navigation-menu">
                        <ul>
                           @foreach($menuData as $key => $menuItem)
                                <li class="{{ Request::is($menuItem['url']) ? 'active' : '' }} has-children{{ isset($menuItem['submenu']) ? ' has-children--multilevel-submenu' : '' }}">
                                    <a href="{{ $menuItem['url'] }}"><span>{{ $menuItem['label'] }}</span></a>
                                    @if(isset($menuItem['submenu']))
                                        <ul class="submenu">
                                            @foreach($menuItem['submenu'] as $submenuItem)
                                                <li class="{{ Request::is($submenuItem['url']) ? 'active' : '' }}">
                                                    <a href="{{ $submenuItem['url'] }}"><span>{{ $submenuItem['label'] }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>

                </div>

                <div class="header-btn text-right d-none d-sm-block ml-lg-4">
                    <a id="donateButton" class="btn-circle btn-default btn" href="#">Donate</a>
                </div>

                <!-- mobile menu -->
                <div class="mobile-navigation-icon d-block d-lg-none" id="mobile-menu-trigger">
                    <i></i>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extend-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen tombol donate berdasarkan ID
        var donateButton = document.getElementById('donateButton');

        // Tambahkan event click
        donateButton.addEventListener('click', function () {
            // Tampilkan notifikasi SweetAlert
            swal({
                title: 'Fitur Belum Tersedia',
                text: 'Maaf, fitur ini masih belum tersedia saat ini.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endpush