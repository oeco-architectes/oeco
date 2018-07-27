<?php
namespace App\Models;

use Intervention\Image\ImageManagerStatic as ImageManager;

/**
 * Represents an image file
 */
class ImageRegistry
{
    public $imageDir;
    public $cacheDir;

    public function __construct($imageDir, $cacheDir)
    {
        $this->imageDir = $imageDir;
        $this->cacheDir = $cacheDir;
    }

    public function getImageHeight($relativePath, $width)
    {
        [$naturalWidth, $naturalHeight] = getimagesize($this->imageDir . DIRECTORY_SEPARATOR . $relativePath);
        return round($width * $naturalHeight / $naturalWidth);
    }

    public function getImageWidth($relativePath, $height)
    {
        [$naturalWidth, $naturalHeight] = getimagesize($this->imageDir . DIRECTORY_SEPARATOR . $relativePath);
        return round($height * $naturalWidth / $naturalHeight);
    }

    public function get($relativePath, $width, $height)
    {
        if (!isset($width) && !isset($height)) {
            throw new \InvalidArgumentException('Either width or height must be set');
        }
        if (!isset($height)) {
            $height = $this->getImageHeight($relativePath, $width);
        }
        if (!isset($width)) {
            $width = $this->getImageWidth($relativePath, $height);
        }

        $pathInfo = self::imagePathInfo($relativePath);
        $path = self::imagePath([
            'directory' => $pathInfo['directory'],
            'basename' => $pathInfo['basename'],
            'width' => $width,
            'height' => $height,
            'extension' => $pathInfo['extension'],
        ]);

        return new Image($path, $width, $height);
    }

    public static function imagePathinfo($imagePath)
    {
        $slash = str_replace('/', '\\/', preg_quote(DIRECTORY_SEPARATOR));
        $imagePathRegExp = implode('', [
            '/^',
            '(?<directory>.*)' . $slash,
            '(?<basename>[^' . $slash . '@.]*)',
            '(@(?<width>\\d*)x(?<height>\\d*))?',
            '.' . '(?<extension>[^' . $slash . '@.]*)',
            '$/',
        ]);
        preg_match($imagePathRegExp, $imagePath, $matches);
        return array_intersect_key($matches, array_flip(['directory', 'basename', 'width', 'height', 'extension']));
    }

    public static function imagePath($pathInfo)
    {
        return implode('', [
            isset($pathInfo['directory']) ? $pathInfo['directory'] . DIRECTORY_SEPARATOR : '',
            $pathInfo['basename'],
            isset($pathInfo['width']) || isset($pathInfo['height']) ? '@' : '',
            isset($pathInfo['width']) ? $pathInfo['width'] : '',
            isset($pathInfo['width']) || isset($pathInfo['height']) ? 'x' : '',
            isset($pathInfo['height']) ? $pathInfo['height'] : '',
            '.',
            $pathInfo['extension'],
        ]);
    }

    public static function unsizedImagePath($imagePath)
    {
        $unsizedImagePathInfo = array_intersect_key(
            self::imagePathinfo($imagePath),
            array_flip(['directory', 'basename', 'extension'])
        );
        return self::imagePath($unsizedImagePathInfo);
    }
}
