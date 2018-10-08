<?php

namespace App;

class DummyImage extends Image
{
    /**
     * List of background colors.
     *
     * @var string[]
     */
    const BACKGROUND_COLORS = [
        '4caf50',
        'd81b60',
        'f57c00',
        '03a9f4',
        '673ab7',
        '009688',
        'f44336',
    ];

    /**
     * Create a dummy image.
     *
     * @param int $width Natural width.
     * @param int $height Natural height.
     * @param string $color Background color, in RRGGBB format.
     * @return DummyImage A new instance of DummyImage.
     */
    public function __construct($width, $height, $color)
    {
        parent::__construct(
            'https://dummyimage.com/' . $width . 'x' . $height . '/' . $color . '/fff',
            $width,
            $height
        );
    }

    /**
     * Pick a background color from the pool, based on a numeric index.
     *
     * @param int $index Any numeric index.
     * @return string A background color from {@see BACKGROUND_COLORS}.
     */
    public static function backgroundColorFromIndex($index)
    {
        return self::BACKGROUND_COLORS[$index % count(self::BACKGROUND_COLORS)];
    }

    /**
     * Create a dummy image, based on given dimensions and a numeric index.
     *
     * @param int $index Any numeric index.
     * @param int $width Natural width.
     * @param int $height Natural height.
     * @return DummyImage  A new instance of DummyImage.
     */
    public static function fromIndex($index, $width, $height)
    {
        return new self($width, $height, self::backgroundColorFromIndex($index));
    }
}
