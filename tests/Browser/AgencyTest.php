<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AgencyTest extends DuskTestCase
{
    use HasNavigationMenu;

    protected function assertContact($browser)
    {
        return $browser
            ->assertSee('Œco Architectes')
            ->assertSee('Adresse')
            ->assertSee('31 Rue Bertrand de Born')
            ->assertSee('Téléphone')
            ->assertSee('+33 (0)5 31 98 98 42')
            ->assertSee('+33 (0)6 71 30 02 61')
            ->assertSee('Adresse électronique')
            ->assertSee('agence@oeco-architectes.com');
    }

    public function testAgencyPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\AgencyPage())
                ->assertSee('Œco Architectes : œuvre collective')
                ->assertElementsCount('@title', 1)
                ->assertElementsCount('@paragraph', 7);
            $this->assertContact($browser);
            $this->assertHasNavigationMenu($browser);
        });
    }

    public function testPublicationsPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Pages\PublicationsPage())
                ->assertSee('Prix & publications')
                ->assertElementsCount('@image', 1);
            $this->assertContact($browser);
            $this->assertHasNavigationMenu($browser);
        });
    }
}
