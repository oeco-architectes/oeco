<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use PHPUnit_Framework_Assert as PHPUnit;

class ProjectPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/projects/test';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        //
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@image' => 'img',
            '@paragraph' => 'p',
        ];
    }
}
