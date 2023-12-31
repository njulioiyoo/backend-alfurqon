<?php

namespace App\Repositories;

use App\Models\About;

class AboutUsRepository implements AboutUsRepositoryInterface
{
    public function getBySlug($type, $key)
    {
        return About::select('slug', 'name', 'image as main_banner', 'attr_1 as youtube_url', 'attr_2 as banner', 'body as description')
            ->where([
                'slug' => $key,
                'active' => '1'
            ])->first();
    }
}
