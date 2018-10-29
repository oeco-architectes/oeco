<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use PHPUnit_Framework_Assert as PHPUnit;

class HomePage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@news' => 'main .oe-carousel__item',
        ];
    }
}
