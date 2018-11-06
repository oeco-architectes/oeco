<?php

namespace Tests;

use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Close all windows between tests. This prevents browser from reusing cached images,
     * which which can be troublesome for testing responsive images.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->closeAll();
        parent::tearDown();
    }

    /**
     * Create the DuskBrowser instance.
     *
     * @param  \Facebook\WebDriver\Remote\RemoteWebDriver $driver
     * @return \Laravel\Dusk\Browser
     */
    protected function newBrowser($driver)
    {
        return new DuskBrowser($driver);
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions())->addArguments([
            '--disable-gpu',
            '--headless',
            '--no-sandbox', // Mandatory for Travis CI, Docker, etc.
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options)
        );
    }

    /**
     * Capture a screenshot of the page for each failed ones.
     * Screenshot are stored in the screenshots/ directory.
     *
     * @param Browser[] $browsers Browser instances
     * @return void
     */
    protected function captureFailuresFor($browsers)
    {
        $browsers->each(function (Browser $browser, $key) {
            $body = $browser->driver->findElement(WebDriverBy::tagName('body'));
            if (!empty($body)) {
                $currentSize = $body->getSize();
                $size = new WebDriverDimension($currentSize->getWidth(), $currentSize->getHeight());
                $browser->driver
                    ->manage()
                    ->window()
                    ->setSize($size);
            }
            $browser->screenshot("failure-{$this->getName()}-{$key}");
        });
    }
}
