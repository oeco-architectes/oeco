<?php

namespace App\Http\Middleware;

use Closure;
use Menu;

class GenerateMenus
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
        Menu::make('navigationMenu', function ($menu) {
            $menu->add('Projets', 'projects');
            $menu->add('Agence', 'agency');
            $menu->add(
                '<img src="/img/facebook-icon.svg">',
                'https://www.facebook.com/OECO-Architectes-143451935789053/'
            );
        });

        return $next($request);
    }
}
