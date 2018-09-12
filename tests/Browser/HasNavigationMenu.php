<?php

namespace Tests\Browser;

trait HasNavigationMenu
{
    public function assertHasNavigationMenu($browser)
    {
        return $browser
            ->assertSeeLinkWithHref('Projets', 'projects')
            ->assertSeeLinkWithHref('Agence', 'agency');
    }
}
