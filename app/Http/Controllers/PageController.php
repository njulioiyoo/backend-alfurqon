<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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

    public function show($type, $slug, $repository, $view, $detail = '')
    {
        // Gunakan getDetailBySlug jika $detail tidak kosong, jika tidak, gunakan getBySlug
        $data = $detail
            ? $this->{$repository}->getDetailBySlug($type, $slug, $detail)
            : $this->{$repository}->getBySlug($type, $slug);

        return view("pages.{$view}", compact('data'));
    }

    public function about($slug)
    {
        return $this->show('about', $slug, 'aboutUsRepository', 'about');
    }

    public function gallery($slug)
    {
        return $this->show('gallery', $slug, 'galleryRepository', 'gallery');
    }

    public function news($slug)
    {
        // Jangan mengirimkan parameter $slug yang tidak diperlukan pada metode news
        return $this->show('news_type', $slug, 'newsRepository', 'news');
    }

    public function detailNews($newsType, $slug)
    {
        // Kirimkan $newsType sebagai parameter tambahan
        return $this->show('news_type', $newsType, 'newsRepository', 'detail-news', $slug);
    }

    public function contact()
    {
        if (request()->isMethod('POST')) {
            $rules = [
                'name'    => 'required|regex:/^[A-Za-z0-9,. -:]+$/',
                'email'   => 'required|email',
                'message' => 'required|regex:/^[A-Za-z0-9,. -:]+$/',
                'captcha' => 'required|captcha'
            ];

            $validator = validator()->make(request()->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('contact')->withInput()->withErrors($validator);
            }

            Contact::create([
                'name'    => request()->name,
                'email'   => request()->email,
                'message' => request()->message,
            ]);

            return redirect()->route('contact');
        }

        return view('pages.contact');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function program($slug)
    {
        // Jangan mengirimkan parameter $slug yang tidak diperlukan pada metode news
        return $this->show('program_type', $slug, 'newsRepository', 'program');
    }
}
