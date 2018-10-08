<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use PHPUnit_Framework_Assert as PHPUnit;

class ProjectsPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/projects';
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@project' => '.oe-mozaic__item',
            '@project-small' => '.oe-mozaic__item--small',
            '@project-tall' => '.oe-mozaic__item--tall',
            '@project-wide' => '.oe-mozaic__item--wide',
        ];
    }
}
