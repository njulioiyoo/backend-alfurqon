<div class="breadcrumb-area bg-overlay-black-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="breadcrumb-title text-white">@yield('breadcrumb-title')</h3>
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Halaman Utama</a>
                    </li>
                    @yield('breadcrumbs')
                </ul>
            </div>
        </div>
    </div>
</div>
