<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert;

class DuskBrowserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Browser::macro('assertCount', function ($expectedCount, $haystack, $message = '') {
            Assert::assertCount($expectedCount, $haystack, $message);
            return $this;
        });
    }
}
