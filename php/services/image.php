<?php
try {
  require_once realpath(__DIR__ . '/../bootstrap.php');

  // Check path

  if(!isset($_GET['path'])) {
    throw new Exception('Missing parameter path', 400);
  }
  $path = $_GET['path'];

  if(!preg_match('/^(news\/|projects\/[a-z0-9]+(-[a-z0-9]+)*\/)[a-z0-9]+(-[a-z0-9]+)*\.jpg$/', $path)) {
    throw new Exception('Invalid image path "' . $path . '"', 400);
  }

  $realPath = 'data/img/' . $path;
  $cachingEnabled = true;

  if(!file_exists($realPath)) {
     $realPath = 'data/img/1x1.png';
     $cachingEnabled = false;
  }

  // Check width
  if (isset($_GET['width'])) {
    $width = $_GET['width'];
    if (!preg_match('/^[1-9][0-9]*$/', $width)) {
      throw new Exception('Invalid width "' . $width . '"', 400);
    }
  }
  else {
    $width = false;
  }

  // Check height
  if (isset($_GET['height'])) {
    $height = $_GET['height'];
    if (!preg_match('/^[1-9][0-9]*$/', $height)) {
      throw new Exception('Invalid width "' . $height . '"', 400);
    }
  }
  else {
    $height = false;
  }

  // Cache
  $cachePath = 'data/cache/' . preg_replace('/\.jpg$/', '', $path) . '@' . $width . 'x' . $height . '.jpg';


  // Generate image
  /*if (!$height && !$width) {
    $rawData = file_get_contents($realPath);
  }
  else*/if ($cachingEnabled && file_exists($cachePath)) {
    $rawData = file_get_contents($cachePath);
  }
  else {
    $image = new Model\Image($realPath, $width, $height);
    $rawData = $image->getRawData();

    if ($cachingEnabled) {
      // Create directory structure
      $currentDir = 'data/cache';
      $folders = explode('/', $path);
      array_pop($folders);
      foreach($folders as $folder) {
        $currentDir .= '/' . $folder;
        if(!file_exists($currentDir)) {
          if(!mkdir($currentDir)) {
            throw new Exception('Can\'t create directory "' . $currentDir . '"');
          }
        }
      }
      if(file_put_contents($cachePath, $rawData) === false) {
        throw new Exception('Can\'t write "' . $cachePath . '"');
      }

      foreach (array('path', 'scale', 'srcRatio', 'srcX', 'srcY', 'srcWidthOriginal', 'srcHeightOriginal', 'srcWidth',
        'srcHeight', 'dstRatio', 'dstX', 'dstY', 'dstWidth', 'dstHeight') as $property) {
        header('X-Image-' . ucfirst($property) . ': ' . $image->$property);
      }
    }
  }

  // Show image
  header('Content-Type: image/jpeg');
  echo $rawData;
}
catch(Exception $e) {
  switch($e->getCode()) {
           case 400: header('HTTP/1.0 400 Bad Request');
    break; case 404: header('HTTP/1.0 404 Not Found');
    break; default : header('HTTP/1.0 500 Internal Server Error');
  }
  echo $e->getMessage();
}
