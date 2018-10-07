<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Image;

class ImageTest extends TestCase
{
    const TEST_URI = 'https://dummyimage.com/300x200/4caf50/fff';
    const TEST_WIDTH = 300;
    const TEST_HEIGHT = 200;

    public function testConstructSavesUri()
    {
        $image = new Image(static::TEST_URI, static::TEST_WIDTH, static::TEST_HEIGHT);
        $this->assertSame(static::TEST_URI, $image->uri);
    }

    public function testConstructSavesWidth()
    {
        $image = new Image(static::TEST_URI, static::TEST_WIDTH, static::TEST_HEIGHT);
        $this->assertSame(static::TEST_WIDTH, $image->width);
    }

    public function testConstructSavesHeight()
    {
        $image = new Image(static::TEST_URI, static::TEST_WIDTH, static::TEST_HEIGHT);
        $this->assertSame(static::TEST_HEIGHT, $image->height);
    }
}
