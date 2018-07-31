<?php
namespace App\Models;

/**
 * Represents an image file
 */
class Image
{
    /**
     * Absolute path to the image file.
     * @var string
     */
    public $path;

    /**
     * Natural width of the image.
     * @var int
     */
    public $width;

    /**
     * Natural height of the image.
     * @var int
     */
    public $height;

    /**
     * Create a new Image instance.
     *
     * @param string $path Absolute path to the image file.
     * @param int $width Natural image width.
     * @param int $height Natural image height.
     */
    public function __construct($path, $width, $height)
    {
        if (empty($path)) {
            throw new \InvalidArgumentException('Missing path parameter.');
        }
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }

    public function toHtmlImgTag($baseUrl, $title = '', $class = null)
    {
        return '<img src="' . $baseUrl . '/' . \htmlentities($this->path)
            . '" alt="' . \htmlentities($title)
            . '" width="' . $this->width
            . '" height="' . $this->height
            . (isset($class) ? '" class="' . $class : '')
            . '">';
    }
}
