<?php

namespace App\Http\Middleware;

use Closure;
use App\Subsystem;

class SetCurrentSubsystem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->segment(1) ?? '';
        $data = Subsystem::getEnabled()->firstWhere('route', $route);
        if (!$data) throw new \Exception("Unable to determine current subsystem");
        
        Subsystem::$currentSubsystemData = $data;
        return $next($request);
    }
}
