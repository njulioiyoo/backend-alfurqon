<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Content;
use App\Models\News;
use App\Models\Program;
use App\Models\Donation;
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

        $programData = Program::with('parent')->where('active', '1')->where('is_highlight', '1')->orderBy('created_at', 'desc')->limit(3)->get();
        $serviceData = [];
        foreach ($programData as $program) {
            $serviceData[] = [
                'image' => $program->image, // Change to the actual image attribute in your Program model
                'slug' => $program->slug,
                'title' => $program->name,
                'source' => $program->source,
                'source_type' => $program->source_type,
                'content' => $program->body,
                'parent' => $program->parent->slug,
                'created_at' => $program->created_at,
            ];
        }

        // Sample data for the "Donation" section
        $donationData = Donation::select('name', 'slug', 'image', 'description', 'attr_2 as amount')
            ->where('active', 1)
            ->get();

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

        return view('welcome', compact('data'));
    }

    private function shareSocialMedia($data)
    {
        return \Share::page(url()->current(), $data['name'])
            ->facebook()
            ->twitter()
            ->linkedin('Extra linkedin summary can be passed here')
            ->whatsapp();
    }

    public function show($type, $slug, $repository, $view, $detail = '')
    {
        // Gunakan getDetailBySlug jika $detail tidak kosong, jika tidak, gunakan getBySlug
        $data = $detail
            ? $this->{$repository}->getDetailBySlug($type, $slug, $detail)
            : $this->{$repository}->getBySlug($type, $slug);

        $share = $this->shareSocialMedia($data);

        return view("pages.{$view}", compact('data', 'share'));
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
                'name'      => 'required|regex:/^[A-Za-z0-9,. -:]+$/',
                'email'     => 'required|email',
                'telephone' => 'required',
                'message'   => 'required|regex:/^[A-Za-z0-9,. -:]+$/',
                'captcha'   => 'required|captcha'
            ];

            $validator = validator()->make(request()->all(), $rules);
            if ($validator->fails()) {
                return redirect()->route('contact')->withInput()->withErrors($validator);
            }

            Contact::create([
                'name'      => request()->name,
                'email'     => request()->email,
                'telephone' => request()->telephone,
                'message'   => request()->message,
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

    public function detailProgram($programType, $slug)
    {
        return $this->show('program_type', $programType, 'newsRepository', 'detail-program', $slug);
    }

    public function detailDonation($slug)
    {
        $data = Donation::select('name', 'image', 'body', 'attr_2 as amount', 'start_date', 'end_date')->where([
            'slug' => $slug, 'active' => 1
        ])->first();

        $share = $this->shareSocialMedia($data);

        return view('pages.detail-donation', compact('data', 'share'));
    }
}
