<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use PHPUnit_Framework_Assert as PHPUnit;

class PublicationsPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/agency/publications';
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@image' => 'article > img',
        ];
    }
}
