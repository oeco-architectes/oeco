<?php

namespace Model;

class Image {

	public $path;

	public $scale;

	public $srcImage;
	public $srcRatio;
	public $srcX;
	public $srcY;
	public $srcWidth;
	public $srcHeight;
	public $srcWidthOriginal;
	public $srcHeightOriginal;

	public $dstImage;
	public $dstRatio;
	public $dstX;
	public $dstY;
	public $dstWidth;
	public $dstHeight;
	
	public function __construct($path, $width = null, $height = null) {

		// Analyze source
		$this->path = $path;
		$this->srcImage = ImageCreateFromString(file_get_contents($this->path));
		$this->srcWidthOriginal = imagesx($this->srcImage);
		$this->srcHeightOriginal = imagesy($this->srcImage);
		$this->srcRatio = $this->srcWidthOriginal / $this->srcHeightOriginal;

		// Determine sizing (width, height, ratio)
		if (!$width && !$height) { // auto width and height = original
			$this->scale = 1.0;
			$this->dstRatio = $this->srcRatio;
			$this->dstWidth = $this->srcWidthOriginal;
			$this->dstHeight = $this->srcHeightOriginal;
		}
		elseif (!$width) { // auto width
			$this->scale = $height / $this->srcHeightOriginal;
			$this->dstRatio = $this->srcRatio;
			$this->dstWidth = round($this->scale * $this->srcWidthOriginal);
			$this->dstHeight = $height;
		}
		elseif (!$height) { // auto height
			$this->scale = $width / $this->srcWidthOriginal;
			$this->dstRatio = $this->srcRatio;
			$this->dstWidth = $width;
			$this->dstHeight = round($this->scale * $this->srcHeightOriginal);
		}
		else { // manual width and height (dest ratio can be different than original)
			$this->dstWidth = $width;
			$this->dstHeight = $height;
			$this->dstRatio = $this->dstWidth / $this->dstHeight;
			if ($this->dstRatio > $this->srcRatio) { // dest ratio is "thinner"
				$this->scale = $this->dstWidth / $this->srcWidthOriginal;
			}
			else { // dest ratio is "thicker"
				$this->scale = $this->dstHeight / $this->srcHeightOriginal;
			}
		}

		// Determine cropping
		$this->srcX = round(($this->srcWidthOriginal  - $this->dstWidth  / $this->scale) / 2);
		$this->srcY = round(($this->srcHeightOriginal - $this->dstHeight / $this->scale) / 2);
		$this->dstX = 0;
		$this->dstY = 0;

		// Adjust src size depending on
		$this->srcWidth  = $this->srcWidthOriginal  - 2 * $this->srcX;
		$this->srcHeight = $this->srcHeightOriginal - 2 * $this->srcY;
	}
	
	public function display()
	{
		$this->dstImage = ImageCreateTrueColor($this->dstWidth, $this->dstHeight);
		if (is_resource($this->dstImage) === true)
		{
			ImageSaveAlpha($this->dstImage, true);
			ImageAlphaBlending($this->dstImage, true);
			ImageFill($this->dstImage, 0, 0, ImageColorAllocate($this->dstImage, 255, 255, 255));
			ImageCopyResampled(
				$this->dstImage,
				$this->srcImage,
				$this->dstX,
				$this->dstY,
				$this->srcX,
				$this->srcY,
				$this->dstWidth,
				$this->dstHeight,
				$this->srcWidth,
				$this->srcHeight
			);
			ImageInterlace($this->dstImage, true);
			ImageJPEG($this->dstImage, null, 90);
		}
	}
	
	public function getRawData() {
		ob_start();
		$this->display();
		return ob_get_clean();
	}
}