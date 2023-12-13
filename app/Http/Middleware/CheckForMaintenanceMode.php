<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Configuration;
use App\Models\Configuration as ModelsConfiguration;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $maintenance = ModelsConfiguration::where('key', '=', 'is_maintenance')->first();
        if ($maintenance->value == '1' && !$request->is('admin*')) {
            return new Response(view('components.maintenance'));
        };

        return $next($request);
    }
}
