<?php
namespace App\Models;

use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testConstructorSetsProperties()
    {
        $image = new Image('/path/to/image.jpg', 800, 600);
        $this->assertEquals('/path/to/image.jpg', $image->path);
        $this->assertEquals(800, $image->width);
        $this->assertEquals(600, $image->height);
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testConstructorFailsWhenMissingWidth()
    {
        new Image('/path/to/image.jpg');
    }

    /**
     * @expectedException ArgumentCountError
     */
    public function testConstructorFailsWhenMissingHeight()
    {
        new Image('/path/to/image.jpg', 800);
    }

    public function testConstructorAcceptsNullWidth()
    {
        $image = new Image('/path/to/image.jpg', null, 600);
        $this->assertEquals(null, $image->width);
    }

    public function testConstructorAcceptsNullHeight()
    {
        $image = new Image('/path/to/image.jpg', 800, null);
        $this->assertEquals(null, $image->height);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorDoesntAcceptNullPath()
    {
        new Image(null, null, null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructorDoesntAcceptEmptyPath()
    {
        new Image('', null, null);
    }
}
