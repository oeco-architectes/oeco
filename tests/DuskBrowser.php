<?php

namespace Tests;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert as PHPUnit;

class DuskBrowser extends Browser
{
    public function assertSeeLinkWithHref($link, $href)
    {
        // Error message
        $message = "Did not see expected link [{$link}] with href [{$href}].";
        if ($this->resolver->prefix) {
            $message .= " within [{$this->resolver->prefix}].";
        }

        $anchor = $this->resolver->find("a[href$='{$href}']");
        $hasText = $anchor && (strpos($anchor->getText(), $link) !== false);
        PHPUnit::assertTrue($anchor && $hasText, $message);

        return $this;
    }

    public function assertElementsCount($selector, $expectedCount)
    {
        $elements = $this->elements($selector);
        $actualCount = count($elements);

        // Error message
        $message = "Found [{$actualCount}] elements instead of [{$expectedCount}] with selector [{$selector}].";
        if ($this->resolver->prefix) {
            $message .= " within [{$this->resolver->prefix}].";
        }

        PHPUnit::assertEquals($expectedCount, $actualCount, $message);

        return $this;
    }
}
