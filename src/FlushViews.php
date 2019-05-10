<?php

namespace GDasilva\Matryoshka;

use Closure;

class FlushViews
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
        if (app()->environment() === 'local')
        {
            // clear the view-specific cache
            //Cache::tags('views')->flush();
        }

        return $next($request);
    }
}
