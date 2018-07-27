<?php
use \App\Models\ImageRenderer;
use \App\Models\ImageServerFactory;

try {
    require_once realpath(__DIR__ . '/../Bootstrap.php');

    // Check path
    if (!isset($_GET['path'])) {
        throw new Exception('Missing parameter path', 400);
    }
    $path = $_GET['path'];

    if (!preg_match('/^(news\/|projects\/[a-z0-9]+(-[a-z0-9]+)*\/)[a-z0-9]+(-[a-z0-9]+)*\.jpg$/', $path)) {
        throw new Exception('Invalid image path "' . $path . '"', 400);
    }

    // Check width
    if (isset($_GET['width'])) {
        $width = $_GET['width'];
        if (!preg_match('/^[1-9][0-9]*$/', $width)) {
            throw new Exception('Invalid width "' . $width . '"', 400);
        }
    } else {
        $width = null;
    }

    // Check height
    if (isset($_GET['height'])) {
        $height = $_GET['height'];
        if (!preg_match('/^[1-9][0-9]*$/', $height)) {
            throw new Exception('Invalid height "' . $height . '"', 400);
        }
    } else {
        $height = null;
    }

    // Serve image using Glide
    $server = ImageServerFactory::create([
        'source' => $config->data->imgDir,
        'cache' => $config->data->cacheDir,
        'cache_with_file_extensions' => true,
    ]);
    $server->outputImage($path, ['w' => $width, 'h' => $height, 'fit' => 'crop', 'fm' => 'pjpg']);
} catch (Exception $e) {
    switch ($e->getCode()) {
        case 400:
            header('HTTP/1.0 400 Bad Request');
            break;
        case 404:
                  header('HTTP/1.0 404 Not Found');
            break;
        default:
                  header('HTTP/1.0 500 Internal Server Error');
    }
    echo '<pre>' . print_r($_GET, true) . '</pre>';
    echo $e->getMessage();
}
