<?php

// app/Repositories/PrayerTimesRepository.php
namespace App\Repositories;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PrayerTimesRepository implements PrayerTimesRepositoryInterface
{
    public function getPrayerTimes($request)
    {
        // Mendapatkan informasi lokasi pengguna dari layanan ipapi.co
        $locationData = $this->getUserLocation();

        // Mendapatkan koordinat lintang dan bujur
        $latitude = $locationData['latitude'];
        $longitude = $locationData['longitude'];

        // Mendapatkan jadwal salat berdasarkan koordinat
        $prayerTimes = $this->getPrayerTimesByCoordinates($latitude, $longitude);

        // Format jadwal salat sesuai dengan struktur yang diinginkan
        return $this->formatPrayerTimes($prayerTimes);
    }

    // Mendapatkan informasi lokasi pengguna dari layanan ipapi.co
    private function getUserLocation()
    {
        $url = 'https://ipapi.co/json/';
        $locationResponse = $this->makeHttpRequest($url);

        return json_decode($locationResponse->getBody(), true);
    }

    // Mendapatkan jadwal salat berdasarkan koordinat
    private function getPrayerTimesByCoordinates($latitude, $longitude)
    {
        $url = env('ALADHAN_API_URL') . "/calendar?latitude=$latitude&longitude=$longitude&method=2";
        $prayerTimesResponse = $this->makeHttpRequest($url);

        $prayerTimesData = json_decode($prayerTimesResponse->getBody(), true);

        return $prayerTimesData['data'][0]['timings'];
    }

    // Membuat HTTP request menggunakan Guzzle
    private function makeHttpRequest($url)
    {
        $client = new Client();

        return $client->get($url);
    }

    // Format jadwal salat sesuai dengan struktur yang diinginkan
    private function formatPrayerTimes($prayerTimes)
    {
        $formattedPrayerTimes = [];

        // Daftar nama salat dan ikonnya
        $salatNames = [
            'Fajr' => 'fajr-icon.png',
            'Dhuhr' => 'dhuhr-icon.png',
            'Asr' => 'asr-icon.png',
            'Maghrib' => 'maghrib-icon.png',
            'Isha' => 'isha-icon.png',
        ];

        // Loop melalui daftar nama salat dan buat data yang diformat
        foreach ($salatNames as $salatName => $icon) {
            // Gunakan null coalescing operator untuk memberikan nilai default jika kunci tidak ditemukan
            $formattedPrayerTimes[] = [
                'name' => $salatName,
                'icon' => $icon,
                'time' => $prayerTimes[$salatName] ?? null,
            ];
        }

        return $formattedPrayerTimes;
    }
}
