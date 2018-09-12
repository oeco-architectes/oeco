<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectsTest extends DuskTestCase
{
    public function testProjects()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\ProjectsPage())
                ->assertElementsCount('@project', 30);
        });
    }
}
