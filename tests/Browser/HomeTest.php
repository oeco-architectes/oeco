<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\News;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomeTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/');
            foreach (News::all() as $news) {
                if ($news->order === null) {
                    $page->assertDontSee($news->title);
                } else {
                    $page->assertSee($news->title);
                }
            }
        });
    }
}
