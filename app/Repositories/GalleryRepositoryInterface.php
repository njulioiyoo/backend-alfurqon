<?php

namespace App\Repositories;

interface GalleryRepositoryInterface
{
    public function getBySlug($type, $slug);
}
