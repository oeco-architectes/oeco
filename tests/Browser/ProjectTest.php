<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectTest extends DuskTestCase
{
    use HasNavigationMenu;

    public function testProjectSections()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\ProjectPage())
                ->assertElementsCount('@image', 10)
                ->assertElementsCount('@paragraph', 30);
            $this->assertHasNavigationMenu($browser);
        });
    }
}
