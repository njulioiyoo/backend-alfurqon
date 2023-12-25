<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\News;
use App\Models\Program;
use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\AboutUsRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;

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
        // Sample data for the "Foundation" section
        $foundationData = [
            [
                'image' => 'assets/images/foundation/mosque-fondation-01.png',
                'title' => 'UAE adu Mosque',
                'location' => 'Abu Dhabi, United Arab Emirates',
            ],
        ];

        $programData = Program::where('active', '1')->where('is_highlight', '1')->orderBy('created_at', 'desc')->limit(3)->get();
        $serviceData = [];
        foreach ($programData as $program) {
            $serviceData[] = [
                'image' => $program->image, // Change to the actual image attribute in your Program model
                'title' => $program->name,
                'source' => $program->source,
                'content' => $program->body,
            ];
        }

        // Sample data for the "Donation" section
        $donationData = [
            [
                'image' => 'assets/images/donation/muslim-donate-01.png',
                'title' => 'Education for all rural children.',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Ipsum has been standard dummy text. Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'currentAmount' => 4500.00,
                'goalAmount' => 8500.00,
                'donateLink' => '#',
            ],
            // Add more donation data as needed
        ];

        $newsData = News::with('parent')->where('active', '1')->where('is_highlight', '1')->orderBy('created_at', 'desc')->limit(3)->get();
        $activitiesData = [];
        foreach ($newsData as $news) {
            $activitiesData[] = [
                'image' => $news->image, // Change to the actual image attribute in your Program model
                'time' => \Carbon\Carbon::parse($news->created_at)->format('j M Y'),
                'title' => $news->name,
                'slug'  => $news->slug,
                'news_type'  => $news['parent']->slug,
                'content' => $news->description,
            ];
        }

        // Combine all sections into a single array
        $data = [
            'foundation' => $foundationData,
            'service' => $serviceData,
            'donation' => $donationData,
            'others_activities' => $activitiesData,
        ];
        // dd($data);
        return view('welcome', compact('data'));
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

    public function facility($slug)
    {
        return $this->show('facility_type', $slug, 'newsRepository', 'facility');
    }

    public function detailFacility($facilityType, $slug)
    {
        // Kirimkan $newsType sebagai parameter tambahan
        return $this->show('facility_type', $facilityType, 'newsRepository', 'detail-facility', $slug);
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
