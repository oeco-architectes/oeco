<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectTest extends DuskTestCase
{
    public function testProjectSections()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\ProjectPage())
                ->assertCount(10, $browser->elements('@image'))
                ->assertCount(30, $browser->elements('@paragraph'));
        });
    }
}
