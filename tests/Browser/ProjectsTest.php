<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectsTest extends DuskTestCase
{
    use HasNavigationMenu;

    public function testProjects()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\ProjectsPage())
                ->assertElementsCount('@project', 30);
            $this->assertHasNavigationMenu($browser);
        });
    }
}
