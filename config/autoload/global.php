<?php
declare(strict_types=1);

return [
    'phph-site' => [
        'meetups-data-path' => __DIR__ . '/../../data/meetups/',
        's3' => [
            'credentials' => [
                'key' => 'POPULATE THIS',
                'secret' => 'POPULATE THIS',
            ],
            'region' => 'eu-west-2',
            'version' => 'latest',
            'bucket' => 'POPULATE THIS',
        ],
        'google-recaptcha' => [
            'api-url' => 'https://www.google.com/recaptcha/api/siteverify',
            'site-key' => 'POPULATE THIS',
            'secret-key' => 'POPULATE THIS',
        ],
        'twitter' => [
            'identifier' => 'POPULATE THIS',
            'secret' => 'POPULATE THIS',
            'callback_uri' => 'https://www.phphants.co.uk/account/twitter/callback',
        ],
        'github' => [
            'clientId' => 'POPULATE THIS',
            'clientSecret' => 'POPULATE THIS',
            'redirectUri' => 'https://www.phphants.co.uk/account/github/callback',
        ],
    ],
];
