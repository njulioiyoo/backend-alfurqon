<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\News;

class NewsRepository implements NewsRepositoryInterface
{
    public function getBySlug($type, $slug)
    {
        return Content::with($this->getRelationConstraints())
            ->select('id', 'type', 'slug', 'name', 'body', 'parent_id', 'active', 'created_at')
            ->where('type', $type)
            ->where('slug', $slug)
            ->where('active', '1')
            ->first();
    }

    protected function getRelationConstraints()
    {
        $baseQuery = function ($query) {
            $query->select('name', 'slug', 'image', 'description', 'body', 'source', 'parent_id', 'active', 'created_at')
                ->where('active', '1');
        };

        return [
            'news' => $baseQuery,
            'program' => $baseQuery,
        ];
    }

    public function getDetailBySlug($type, $newsType, $slug)
    {
        $newsType = $this->getBySlug($type, $newsType);

        return News::with('user:id,name,email', 'parent:id,name')
            ->where([
                ['slug', $slug],
                ['parent_id', $newsType->id],
                ['active', '1']
            ])
            ->first(['id', 'name', 'slug', 'image', 'source', 'description', 'body', 'author', 'viewed', 'parent_id', 'created_at']);
    }
}
