<?php

namespace App\Repositories;

use App\Models\Configuration;

class ConfigurationRepository implements ConfigurationRepositoryInterface
{
    public function all()
    {
        return Configuration::all();
    }

    public function getByKey($key)
    {
        return Configuration::where('key', $key)->first();
    }
}
