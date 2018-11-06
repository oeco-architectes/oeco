<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\DummyImage;

class DummyImageTest extends TestCase
{
    const TEST_WIDTH = 300;
    const TEST_HEIGHT = 200;
    const TEST_COLOR = '4caf50';

    public function testConstructSavesWidth()
    {
        $image = new DummyImage(static::TEST_WIDTH, static::TEST_HEIGHT, static::TEST_COLOR);
        $this->assertSame(static::TEST_WIDTH, $image->width);
    }

    public function testConstructSavesHeight()
    {
        $image = new DummyImage(static::TEST_WIDTH, static::TEST_HEIGHT, static::TEST_COLOR);
        $this->assertSame(static::TEST_HEIGHT, $image->height);
    }

    public function testConstructBuildCorrectUri()
    {
        $width = static::TEST_WIDTH;
        $height = static::TEST_HEIGHT;
        $color = static::TEST_COLOR;
        $image = new DummyImage($width, $height, $color);
        $this->assertSame("https://dummyimage.com/{$width}x{$height}/{$color}/fff", $image->uri);
    }

    public function testBackgroundColorFromIndexReturnsFirstColorForZero()
    {
        $firstColor = DummyImage::BACKGROUND_COLORS[0];
        $this->assertSame($firstColor, DummyImage::backgroundColorFromIndex(0));
    }

    public function testBackgroundColorFromIndexReturnsLastColorIndex()
    {
        $colorsNumber = count(DummyImage::BACKGROUND_COLORS);
        $lastColor = DummyImage::BACKGROUND_COLORS[$colorsNumber - 1];
        $this->assertSame($lastColor, DummyImage::backgroundColorFromIndex($colorsNumber - 1));
    }

    public function testBackgroundColorFromIndexReturnsFirstColorForColorsNumber()
    {
        $this->assertSame(
            DummyImage::BACKGROUND_COLORS[0],
            DummyImage::backgroundColorFromIndex(count(DummyImage::BACKGROUND_COLORS))
        );
    }

    public function testFromIndexCreateAnImageWithFirstColorForZero()
    {
        $width = static::TEST_WIDTH;
        $height = static::TEST_HEIGHT;
        $firstColor = DummyImage::BACKGROUND_COLORS[0];
        $image = DummyImage::fromIndex(0, $width, $height);
        $this->assertSame(
            "https://dummyimage.com/{$width}x{$height}/{$firstColor}/fff",
            $image->uri
        );
    }

    public function testFromIndexCreateAnImageWithLastColorIndex()
    {
        $width = static::TEST_WIDTH;
        $height = static::TEST_HEIGHT;
        $colorsNumber = count(DummyImage::BACKGROUND_COLORS);
        $lastColor = DummyImage::BACKGROUND_COLORS[$colorsNumber - 1];
        $image = DummyImage::fromIndex($colorsNumber - 1, $width, $height);
        $this->assertSame(
            "https://dummyimage.com/{$width}x{$height}/{$lastColor}/fff",
            $image->uri
        );
    }

    public function testFromIndexCreateAnImageWithFirstColorForColorsNumber()
    {
        $width = static::TEST_WIDTH;
        $height = static::TEST_HEIGHT;
        $firstColor = DummyImage::BACKGROUND_COLORS[0];
        $image = DummyImage::fromIndex(count(DummyImage::BACKGROUND_COLORS), $width, $height);
        $this->assertSame(
            "https://dummyimage.com/{$width}x{$height}/{$firstColor}/fff",
            $image->uri
        );
    }
}
