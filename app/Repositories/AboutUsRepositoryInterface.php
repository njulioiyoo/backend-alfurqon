<?php

namespace App\Repositories;

interface AboutUsRepositoryInterface
{
    public function all();
    public function getBySlug($key);
}
