<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use PHPUnit_Framework_Assert as PHPUnit;

class AgencyPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/agency';
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@title' => 'article > h2',
            '@paragraph' => 'article > p',
        ];
    }
}
