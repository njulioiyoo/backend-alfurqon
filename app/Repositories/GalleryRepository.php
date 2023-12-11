<?php

namespace App\Repositories;

use App\Models\Photo;
use App\Models\Video;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function allPhoto()
    {
        return Photo::select('body as description', 'image')->where('active', '1')->orderBy('created_at', 'desc')->get();
    }

    public function allVideo()
    {
        return Video::select('source', 'name', 'body as description', 'attr_1 as duration', 'image')->where('active', '1')->orderBy('created_at', 'desc')->get();
    }
}
