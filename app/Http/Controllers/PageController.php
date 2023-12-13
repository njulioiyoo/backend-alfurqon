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

    public function __construct(AboutUsRepositoryInterface $aboutUsRepository, GalleryRepositoryInterface $galleryRepository, NewsRepositoryInterface $newsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
        $this->galleryRepository = $galleryRepository;
        $this->newsRepository = $newsRepository;
    }

    public function home(Request $request)
    {
        // $prayerTimes = $this->prayerTimes->getPrayerTimes($request);

        return view('welcome');
    }

    public function show($slug, $repository, $view, $detail = '')
    {
        // Gunakan getDetailBySlug jika $detail tidak kosong, jika tidak, gunakan getBySlug
        $data = $detail
            ? $this->{$repository}->getDetailBySlug($slug, $detail)
            : $this->{$repository}->getBySlug($slug);

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
        // Jangan mengirimkan parameter $slug yang tidak diperlukan pada metode news
        return $this->show($slug, 'newsRepository', 'news');
    }

    public function detailNews($newsType, $slug)
    {
        // Kirimkan $newsType sebagai parameter tambahan
        return $this->show($newsType, 'newsRepository', 'detail-news', $slug);
    }
}
