<?php

namespace App\Http\Controllers;

use App\Repositories\AboutUsRepositoryInterface;

class AboutUsController extends Controller
{
    private $aboutUsRepository;

    public function __construct(AboutUsRepositoryInterface $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    public function index()
    {
        $aboutUs = $this->aboutUsRepository->all();
        return response()->json($aboutUs);
    }

    public function show($slug)
    {
        $aboutUs = $this->aboutUsRepository->getBySlug($slug);
        return response()->json($aboutUs);
    }
}
