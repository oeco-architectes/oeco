<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeTest extends DuskTestCase
{
    use HasNavigationMenu;

    public function testNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Pages\HomePage())->assertElementsCount('@news', 20);
            $this->assertHasNavigationMenu($browser);
        });
    }
}
