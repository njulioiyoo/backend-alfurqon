<?php

namespace App\Repositories;

interface ConfigurationRepositoryInterface
{
    public function all();
    public function getByKey($key);
}
