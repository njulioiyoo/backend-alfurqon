<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function getBySlug($slug);
    public function getDetailBySlug($newsType, $slug);
}
