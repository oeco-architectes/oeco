<?php

namespace App\Models;

use League\Glide\Server;

class ImageServer extends Server
{
    /**
     * Get cache path.
     * @param  string $path   Image path.
     * @param  array  $params Image manipulation params.
     * @return string Cache path.
     */
    public function getCachePath($path, array $params = [])
    {
        $sourcePath = $this->getSourcePath($path);
        if ($this->sourcePathPrefix) {
            $sourcePath = substr($sourcePath, strlen($this->sourcePathPrefix) + 1);
        }

        $params = $this->getAllParams($params);
        $cachedPath = preg_replace('/\\.[^.]*$/', '', $path) . '@' . $params['w'] . 'x' . $params['h'];

        if ($this->cachePathPrefix) {
            $cachedPath = $this->cachePathPrefix . '/' . $cachedPath;
        }

        if ($this->cacheWithFileExtensions) {
            $ext = (isset($params['fm']) ? $params['fm'] : pathinfo($path)['extension']);
            $ext = ($ext === 'pjpg') ? 'jpg' : $ext;
            $cachedPath .= '.' . $ext;
        }
        return $cachedPath;
    }
}
