<?php

namespace App\Providers;

use App\Repositories\AboutUsRepository;
use App\Repositories\AboutUsRepositoryInterface;
use App\Repositories\GalleryRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PrayerTimesRepository;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\PrayerTimesRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Configuration;
use App\Models\Content;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AboutUsRepositoryInterface::class, AboutUsRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->bind(PrayerTimesRepositoryInterface::class, PrayerTimesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->shareMenuData();
        View::composer('*', function ($view) {
            $siteSettings = Configuration::all();

            foreach ($siteSettings as $setting) {
                $view->with($setting['key'], $setting['value']);
            }
        });
    }

    private function shareMenuData()
    {
        View::composer('*', function ($view) {
            $menuData = $this->getMenuData();
            $view->with('menuData', $menuData);
        });
    }

    private function getMenuData()
    {
        $newsType = Content::select('type', 'slug', 'name', 'active', 'created_at')->where([
            'type' => 'news_type',
            'active' => '1'
        ])->orderBy('created_at', 'desc')->get();

        $newsSubMenu = [];

        foreach ($newsType as $type) {
            $newsSubMenu[] = [
                'url' => route('news', $type->slug),
                'label' => $type->name,
            ];
        }

        $menuData = [
            'about' => [
                'url' => '#',
                'label' => 'TENTANG KAMI',
                'submenu' => [
                    ['url' => route('about', 'history-and-background'), 'label' => 'Sejarah dan latar belakang masjid'],
                    ['url' => route('about', 'vision-and-mission'), 'label' => 'Visi dan misi masjid'],
                    ['url' => '#', 'label' => 'Struktur organisasi dan pimpinan'],
                ],
            ],
            'gallery' => [
                'url' => '#',
                'label' => 'GALERI',
                'submenu' => [
                    ['url' => route('gallery', 'photo'), 'label' => 'Foto-foto masjid, acara, dan kegiatan'],
                    ['url' => route('gallery', 'video'), 'label' => 'Video rekaman acara-acara penting'],
                ],
            ],
            'programs' => [
                'url' => '#',
                'label' => 'PROGRAM',
                'submenu' => [
                    ['url' => '#', 'label' => 'Rekaman khutbah dan ceramah'],
                    ['url' => '#', 'label' => 'Artikel atau teks khutbah terbaru'],
                    ['url' => '#', 'label' => 'Daftar pembicara dan khatib'],
                ],
            ],
            'news' => [
                'url' => '#',
                'label' => 'BERITA DAN PENGUMUMAN',
                'submenu' => $newsSubMenu,
            ],
            'contact' => [
                'url' => '#',
                'label' => 'HUBUNGI KAMI'
            ]
        ];

        return $menuData;
    }
}
