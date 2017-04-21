<?php

return [
    'id'         => 'choateunit',
    'name' => 'choateunit',
    'basePath'   => __DIR__,
    'language'   => 'en-US',
    'components' => [
        'mailer'     => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
