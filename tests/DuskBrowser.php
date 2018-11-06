<?php

namespace Tests;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert as PHPUnit;

class DuskBrowser extends Browser
{
    /**
     * Assert a link is visible on the page.
     *
     * @param string $link Link text.
     * @param string $href Link target URI.
     * @return DuskBrowser This object to allow chaining.
     */
    public function assertSeeLinkWithHref(string $link, string $href)
    {
        // Error message
        $message = "Did not see expected link [{$link}] with href [{$href}].";
        if ($this->resolver->prefix) {
            $message .= " within [{$this->resolver->prefix}].";
        }

        $anchor = $this->resolver->find("a[href$='{$href}']");
        $hasText = $anchor && strpos($anchor->getText(), $link) !== false;
        PHPUnit::assertTrue($anchor && $hasText, $message);

        return $this;
    }

    /**
     * Assert a given number of elements are visible on the page.
     *
     * @param string $selector CSS selector.
     * @param int $expected Expected number of elements matching `$selector`.
     * @return DuskBrowser This object to allow chaining.
     */
    public function assertElementsCount(string $selector, int $expected)
    {
        $elements = $this->elements($selector);
        $actualCount = count($elements);

        // Error message
        $message = "Found [{$actualCount}] elements instead of [{$expected}] with selector [{$selector}].";
        if ($this->resolver->prefix) {
            $message .= " within [{$this->resolver->prefix}].";
        }

        PHPUnit::assertEquals($expected, $actualCount, $message);

        return $this;
    }

    /**
     * Execute JavaScript on the page.
     *
     * @param string $script Javascript code to execute.
     * @return DuskBrowser This object to allow chaining.
     */
    public function executeScript(string $script)
    {
        $errors = $this->script($script);
        PHPUnit::assertEquals([null], $errors, "Script should not return errors:\\n{$script}");
        return $this;
    }

    /**
     * Append a Javascript expression to the page body.
     *
     * @param string $script Javascript expression (string).
     * @return DuskBrowser This object to allow chaining.
     */
    public function appendScript(string $script)
    {
        return $this->executeScript("document.body.innerHTML += {$script};");
    }
}
