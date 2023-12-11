<?php

namespace App\Http\Controllers;

use App\Repositories\GalleryRepositoryInterface;

class GalleryController extends Controller
{
    private $galleryRepository;

    public function __construct(GalleryRepositoryInterface $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * Retrieves all the photo data.
     *
     * @throws Some_Exception_Class Description of exception
     * @return Some_Return_Value
     */
    public function allPhoto()
    {
        $photo = $this->galleryRepository->allPhoto();

        return response()->json($photo);
    }

    public function allVideo()
    {
        $video = $this->galleryRepository->allVideo();

        return response()->json($video);
    }
}
