<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\Assert as PHPUnit;

class ProjectsTest extends DuskTestCase
{
    use HasNavigationMenu;

    const PROJECT_IMAGES_CURRENT_SRC =
        '`<ul>' .
        '    ${' .
        '        Array.from(document.querySelectorAll(".oe-mozaic__item img"))' .
        '            .map(img => `<li>${img.currentSrc}</li>`)' .
        '            .join("")' .
        '    }' .
        '</ul>`';

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

    public function testImagesDimensionsAtXGA()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->resize(1024, 768)
                ->visit(new Pages\ProjectsPage())
                ->appendScript(static::PROJECT_IMAGES_CURRENT_SRC)
                ->assertDontSee('https://dummyimage.com/960x540/')
                ->assertSee('https://dummyimage.com/228x152/')
                ->assertSee('https://dummyimage.com/228x310/')
                ->assertSee('https://dummyimage.com/462x152/');
        });
    }

    public function testImagesDimensionsAt1080p()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->resize(1920, 1080)
                ->visit(new Pages\ProjectsPage())
                ->appendScript(static::PROJECT_IMAGES_CURRENT_SRC)
                ->assertDontSee('https://dummyimage.com/960x540/')
                ->assertSee('https://dummyimage.com/300x200/')
                ->assertSee('https://dummyimage.com/300x406/')
                ->assertSee('https://dummyimage.com/606x200/');
        });
    }

    public function testImagesDimensionsAtLowResolution()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->resize(320, 568)
                ->visit(new Pages\ProjectsPage())
                ->appendScript(static::PROJECT_IMAGES_CURRENT_SRC)
                ->assertSee('https://dummyimage.com/960x540/');
        });
    }
}
