<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $website_name }} - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    @foreach (['vendor/bootstrap.min.css', 'vendor/flaticon.css', 'plugins/swiper.min.css', 'plugins/magnific-popup.css', 'style.css', 'sweetalert.min.css'] as $style)
        <link rel="stylesheet" href="{{ asset("assets/css/$style") }}">
    @endforeach

    <style>
        div#social-links {
            position: fixed;
            top: 50%; /* Anda dapat menyesuaikan posisi vertikal sesuai kebutuhan */
            transform: translateY(-50%);
            max-width: 500px;
            float: left; /* Mengubah floating menjadi di sebelah kiri */
            left: 0; /* Menempatkan elemen di sebelah kiri */
        }

        div#social-links ul {
            list-style-type: none;
            margin: 0;
            padding: 5px; /* Mengatur padding agar kotak ul menjadi kecil */
        }

        div#social-links ul li {
            display: block; /* Mengubah display menjadi block agar tidak mengambang di samping */
            margin-bottom: 5px; /* Menambahkan ruang antara setiap ikon sosial */
        }

        div#social-links ul li a {
            display: block; /* Mengubah display menjadi block agar tidak mengambang di samping */
            padding: 10px; /* Mengatur padding agar ikon menjadi lebih kecil */
            border: 1px solid #ccc;
            font-size: 20px; /* Mengurangi ukuran font ikon */
            color: #222;
            background-color: #ccc;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header-area header-area--default">
        <header class="header-area header-sticky">
            @include('templates.header')
        </header>
    </div>

    @yield('content')

    <footer class="footer-area bg-footer">
        @include('templates.footer')
    </footer>

    <a href="#" class="scroll-top" id="scroll-top">
        <i class="arrow-top flaticon-up-arrow"></i>
        <i class="arrow-bottom flaticon-up-arrow"></i>
    </a>
    <div class="mobile-menu-overlay" id="mobile-menu-overlay">
        @include('components.mobile-header')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}"></script>

    @foreach (['vendor/modernizr-2.8.3.min.js', 'vendor/jquery-3.5.1.min.js', 'vendor/jquery-migrate-3.3.0.min.js', 'vendor/bootstrap.min.js', 'plugins/swiper.min.js', 'plugins/waypoints.min.js', 'plugins/counterup.min.js', 'plugins/jquery.magnific-popup.min.js', 'plugins/wow.min.js', 'plugins/ajax.mail.js', 'main.js', 'sweetalert.min.js'] as $script)
        <script src="{{ asset("assets/js/$script") }}"></script>
    @endforeach

    @stack('extend-scripts')

    <script text="type/javascript">
        // Fungsi untuk mendapatkan waktu shalat dari API Aladhan
        function getPrayerTimes(latitude, longitude) {
            var xhr = new XMLHttpRequest();
            var today = new Date();

            var dd = String(today.getDate()).padStart(2, '0'); 
            var mm = String(today.getMonth() + 1).padStart(2, '0'); 
            var yyyy = today.getFullYear();

            var formattedDate = dd + '-' + mm + '-' + yyyy;

            var apiUrl = 'https://api.aladhan.com/v1/timings/' + formattedDate + '?latitude=' + latitude + '&longitude=' + longitude + '&method=20';
            xhr.open('GET', apiUrl, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    var prayerTimes = responseData.data.timings;

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

        // Fungsi untuk menampilkan waktu shalat dalam format HTML
        function displayPrayerTimes(prayerTimes) {
            var container = document.getElementById('prayerTimesContainer');
            var infoContainer = document.getElementById('prayerTimesInfoContainer');
            
            // Pemeriksaan apakah elemen ditemukan sebelum mengakses propertinya
            if (container) {
                container.innerHTML = ''; // Menghapus konten sebelumnya

                prayerTimes.forEach(function (prayerTime) {
                    // Tambahkan elemen HTML ke container waktu shalat
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

            if (infoContainer) {
                infoContainer.innerHTML = ''; // Menghapus konten sebelumnya

                prayerTimes.forEach(function (prayerTime) {
                    // Tambahkan informasi waktu shalat ke container informasi
                    var infoHtml = `<li>${prayerTime.name}: ${prayerTime.time}</li>`;
                    infoContainer.innerHTML += infoHtml;
                });
            }
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
    </script>
</body>

</html>