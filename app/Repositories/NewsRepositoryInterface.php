<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function getBySlug($type, $slug);
    public function getDetailBySlug($type, $newsType, $slug);
}
