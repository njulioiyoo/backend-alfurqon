<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    public function getBySlug($slug)
    {
        return Content::with(['news' => function ($query) {
            $query->select('name', 'slug', 'image', 'description', 'parent_id', 'active', 'created_at')
                ->where('active', '1');
        }])
            ->select('id', 'type', 'slug', 'name', 'parent_id', 'active', 'created_at')
            ->where('type', 'news_type')
            ->where('slug', $slug)
            ->where('active', '1')
            ->first();
    }

    public function getDetailBySlug($newsType, $slug)
    {
        $newsType = $this->getBySlug($newsType);

        return News::with('user:id,name,email', 'parent:id,name')
            ->where([
                ['slug', $slug],
                ['parent_id', $newsType->id],
                ['active', '1']
            ])
            ->first(['id', 'name', 'slug', 'image', 'source', 'description', 'body', 'author', 'viewed', 'parent_id', 'created_at']);
    }
}
