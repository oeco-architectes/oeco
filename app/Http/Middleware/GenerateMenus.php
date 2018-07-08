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
            $menu->add('Projets', 'projets');
            $menu->add('Agence', 'agence');
            $menu->add(
                '<img src="img/facebook-icon.svg">',
                'https://www.facebook.com/OECO-Architectes-143451935789053/'
            );
            $menu->all()->attr('class', 'oeco-site-navigation__menu-item');
        });
        return $next($request);
    }
}
