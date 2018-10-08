<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\Assert as PHPUnit;

class ProjectsTest extends DuskTestCase
{
    use HasNavigationMenu;

    public function testProjects()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\ProjectsPage())

                // Total projects
                ->assertElementsCount('@project', 30)

                // Each tile format exist
                ->assertPresent('@project@project-small')
                ->assertPresent('@project@project-tall')
                ->assertPresent('@project@project-wide')

                // Each project has only 1 modifier
                ->assertElementsCount('@project@project-small, @project@project-tall, @project@project-wide', 30)
                ->assertMissing('@project:not(@project-small):not(@project-tall):not(@project-wide)');
            $this->assertHasNavigationMenu($browser);
        });
    }
}
