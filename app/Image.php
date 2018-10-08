<?php

namespace App;

/**
 * Image.
 */
class Image
{
    /**
     * URI.
     *
     * @var string
     */
    public $uri;

    /**
     * Natural width.
     *
     * @var int
     */
    public $width;

    /**
     * Natural height.
     *
     * @var [type]
     */
    public $height;

    /**
     * Create a new Image instance.
     *
     * @param string $uri URI.
     * @param int $width Natural width.
     * @param int $height Natural height.
     */
    public function __construct(string $uri, int $width, int $height)
    {
        $this->uri = $uri;
        $this->width = $width;
        $this->height = $height;
    }
}
