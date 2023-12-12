<?php

namespace App\Repositories;

use App\Models\Content;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function getBySlug($slug)
    {
        return Content::select('type', 'source', 'name', 'body as description', 'attr_1 as duration', 'image')
            ->where([
                'type' => $slug,
                'active' => '1'
            ])
            ->orderBy('created_at', 'desc')->get();
    }
}
