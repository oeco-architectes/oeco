<?php
// Ensure environment variables are set
foreach (['FTP_USERNAME', 'FTP_PASSWORD', 'FTP_HOST', 'FTP_PATH'] as $env) {
    $value = getenv($env);
    if ($value === false) {
        throw new Exception($env . ' environment variable is not set.');
    }
    if (empty($value)) {
        throw new Exception($env . ' environment variable is empty.');
    }
}

return [
    'ftp' => [
        'remote' =>
            'ftp://' .
                getenv('FTP_USERNAME') .
                ':' .
                getenv('FTP_PASSWORD') .
                '@' .
                getenv('FTP_HOST') .
                '/' .
                getenv('FTP_PATH'),
        'local' => '.',
        'ignore' => [
            '/coverage',
            '/node_modules',
            '/storage/framework/cache/*',
            '/storage/framework/sessions/*',
            '/storage/framework/testing/*',
            '/storage/framework/views/*',
            '/vendor',
            '/.*',
            '/package.json',
            '/package-lock.json',
            '/phpunit.xml',
            '/*.md',
            '*.sqlite',
            '*.log',
            '.gitignore',
            '.gitkeep',
        ],
        'allowDelete' => true,
        'purge' => ['temp/cache'],
        'preprocess' => false,
    ],
    'tempDir' => __DIR__ . '/.deployment',
    'colors' => true,
];
