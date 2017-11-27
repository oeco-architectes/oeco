<?php

return [
    'oeco' => [
        'remote' => 'ftp://'
            . getenv('DEPLOY_FTP_USERNAME') . ':' . getenv('DEPLOY_FTP_PASSWORD')
            . '@' . getenv('DEPLOY_FTP_URL') . '/' . getenv('DEPLOY_PATH'),
        'local' => '.',
        'ignore' => file_get_contents('.deployignore'),
        'allowDelete' => true,
        'purge' => ['temp/cache'],
        'preprocess' => false,
        'after' => [
            'upload: .env.' . getenv('DEPLOY_ENVIRONMENT') . ' .env'
        ]
    ],
    'tempDir' => __DIR__ . '/temp',
    'colors' => true,
];
