<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    public function getBySlug($slug)
    {
        $data = Content::select('id', 'type', 'slug', 'name', 'parent_id', 'active', 'created_at')
            ->where([
                'type' => 'news_type',
                'slug' => $slug,
                'active' => '1'
            ])->with(['news' => function ($query) {
                $query->select('name', 'slug', 'image', 'description', 'parent_id', 'active', 'created_at');
            }])->first();

        return $data;
    }
}
