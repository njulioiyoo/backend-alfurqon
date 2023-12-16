<?php

namespace App\Repositories;

interface AboutUsRepositoryInterface
{
    public function getBySlug($type, $key);
}
