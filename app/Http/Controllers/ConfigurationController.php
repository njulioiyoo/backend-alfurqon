<?php

namespace App\Http\Controllers;

use App\Repositories\ConfigurationRepositoryInterface;

class ConfigurationController extends Controller
{
    protected $configurationRepository;

    public function __construct(ConfigurationRepositoryInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    public function index()
    {
        $configurations = $this->configurationRepository->all();
        return response()->json($configurations);
    }

    public function show($key)
    {
        $configuration = $this->configurationRepository->getByKey($key);
        return response()->json($configuration);
    }
}
