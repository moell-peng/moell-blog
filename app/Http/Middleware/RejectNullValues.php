<?php

namespace App\Http\Middleware;

use Closure;

class RejectNullValues
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
        $params = collect($request)->map(function ($item) {
            return is_null($item) ? '' : $item;
        });
        $request->replace($params->all());
        return $next($request);
    }
}
