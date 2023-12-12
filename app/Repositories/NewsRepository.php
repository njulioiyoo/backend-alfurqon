<?php

namespace App\Repositories;

use App\Models\Content;

class NewsRepository implements NewsRepositoryInterface
{
    public function getBySlug($slug)
    {
        return Content::select('type', 'slug', 'name', 'active', 'created_at')
            ->where([
                'type' => $slug,
                'active' => '1'
            ])
            ->orderBy('created_at', 'desc')->get();
    }
}
