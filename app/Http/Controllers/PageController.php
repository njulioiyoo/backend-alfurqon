<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\AboutUsRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\PrayerTimesRepositoryInterface;

class PageController extends Controller
{
    private $aboutUsRepository;
    private $galleryRepository;
    private $newsRepository;
    private $prayerTimes;

    public function __construct(AboutUsRepositoryInterface $aboutUsRepository, GalleryRepositoryInterface $galleryRepository, PrayerTimesRepositoryInterface $prayerTimes, NewsRepositoryInterface $newsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
        $this->galleryRepository = $galleryRepository;
        $this->newsRepository = $newsRepository;
        $this->prayerTimes = $prayerTimes;
    }

    public function home(Request $request)
    {
        // $prayerTimes = $this->prayerTimes->getPrayerTimes($request);

        return view('welcome');
    }

    public function show($slug, $repository, $view)
    {
        $data = $this->{$repository}->getBySlug($slug);

        return view("pages.{$view}", compact('data'));
    }

    public function about($slug)
    {
        return $this->show($slug, 'aboutUsRepository', 'about');
    }

    public function gallery($slug)
    {
        return $this->show($slug, 'galleryRepository', 'gallery');
    }

    public function news($slug)
    {
        return $this->show($slug, 'newsRepository', 'news');
    }
}
