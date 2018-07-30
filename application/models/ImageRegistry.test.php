<?php
namespace App\Models;

use PHPUnit\Framework\TestCase;

class ImageRegistryTest extends TestCase
{
    public function testPathInfoWithoutSize()
    {
        $info = ImageRegistry::imagePathinfo('path/to/image.ext');
        $this->assertEquals($info['directory'], 'path/to');
        $this->assertEquals($info['basename'], 'image');
        $this->assertEquals($info['width'], null);
        $this->assertEquals($info['height'], null);
        $this->assertEquals($info['extension'], 'ext');
        $this->assertEquals(array_keys($info), ['directory', 'basename', 'width', 'height', 'extension']);
    }

    public function testPathInfoWithWidth()
    {
        $info = ImageRegistry::imagePathinfo('path/to/image@800x.ext');
        $this->assertEquals($info['directory'], 'path/to');
        $this->assertEquals($info['basename'], 'image');
        $this->assertEquals($info['width'], 800);
        $this->assertEquals($info['height'], null);
        $this->assertEquals($info['extension'], 'ext');
        $this->assertEquals(array_keys($info), ['directory', 'basename', 'width', 'height', 'extension']);
    }

    public function testPathInfoWithHeight()
    {
        $info = ImageRegistry::imagePathinfo('path/to/image@x600.ext');
        $this->assertEquals($info['directory'], 'path/to');
        $this->assertEquals($info['basename'], 'image');
        $this->assertEquals($info['width'], null);
        $this->assertEquals($info['height'], 600);
        $this->assertEquals($info['extension'], 'ext');
        $this->assertEquals(array_keys($info), ['directory', 'basename', 'width', 'height', 'extension']);
    }

    public function testPathInfoWithWidthAndHeight()
    {
        $info = ImageRegistry::imagePathinfo('path/to/image@800x600.ext');
        $this->assertEquals($info['directory'], 'path/to');
        $this->assertEquals($info['basename'], 'image');
        $this->assertEquals($info['width'], 800);
        $this->assertEquals($info['height'], 600);
        $this->assertEquals($info['extension'], 'ext');
        $this->assertEquals(array_keys($info), ['directory', 'basename', 'width', 'height', 'extension']);
    }

    public function testImagePathWithoutSize()
    {
        $path = ImageRegistry::imagePath([
            'directory' => 'path/to',
            'basename' => 'image',
            'width' => null,
            'height' => null,
            'extension' => 'ext',
        ]);
        $this->assertEquals($path, 'path/to/image.ext');
    }

    public function testImagePathWithWidth()
    {
        $path = ImageRegistry::imagePath([
            'directory' => 'path/to',
            'basename' => 'image',
            'width' => 800,
            'height' => null,
            'extension' => 'ext',
        ]);
        $this->assertEquals($path, 'path/to/image@800x.ext');
    }

    public function testImagePathWithHeight()
    {
        $path = ImageRegistry::imagePath([
            'directory' => 'path/to',
            'basename' => 'image',
            'width' => null,
            'height' => 600,
            'extension' => 'ext',
        ]);
        $this->assertEquals($path, 'path/to/image@x600.ext');
    }

    public function testImagePathWithWidthAndHeight()
    {
        $path = ImageRegistry::imagePath([
            'directory' => 'path/to',
            'basename' => 'image',
            'width' => 800,
            'height' => 600,
            'extension' => 'ext',
        ]);
        $this->assertEquals($path, 'path/to/image@800x600.ext');
    }

    public function testUnsizedImagePath()
    {
        $this->assertEquals(ImageRegistry::unsizedImagePath('path/to/image.ext'), 'path/to/image.ext');
        $this->assertEquals(ImageRegistry::unsizedImagePath('path/to/image@800x.ext'), 'path/to/image.ext');
        $this->assertEquals(ImageRegistry::unsizedImagePath('path/to/image@x600.ext'), 'path/to/image.ext');
        $this->assertEquals(ImageRegistry::unsizedImagePath('path/to/image@800x600.ext'), 'path/to/image.ext');
    }
}
