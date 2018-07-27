<?php

namespace App\Models;

use League\Glide\ServerFactory;

class ImageServerFactory extends ServerFactory
{
    /**
     * Get configured server.
     * @return ImageServer Configured Glide server.
     */
    public function getServer()
    {
        $server = new ImageServer(
            $this->getSource(),
            $this->getCache(),
            $this->getApi()
        );
        $server->setSourcePathPrefix($this->getSourcePathPrefix());
        $server->setCachePathPrefix($this->getCachePathPrefix());
        $server->setGroupCacheInFolders($this->getGroupCacheInFolders());
        $server->setCacheWithFileExtensions($this->getCacheWithFileExtensions());
        $server->setDefaults($this->getDefaults());
        $server->setPresets($this->getPresets());
        $server->setBaseUrl($this->getBaseUrl());
        $server->setResponseFactory($this->getResponseFactory());
        return $server;
    }


    /**
     * Create configured server.
     * @param  array  $config Configuration parameters.
     * @return ImageServer Configured server.
     */
    public static function create(array $config = [])
    {
        return (new self($config))->getServer();
    }
}
