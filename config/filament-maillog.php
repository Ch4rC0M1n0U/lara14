<?php

return [
    'amazon-ses' => [
        'configuration-set' => null,
    ],

    'resources' => [
        'MaiLogResource' => \Tapp\FilamentMailLog\Resources\MailLogResource::class,
    ],

    'navigation' => [
        'maillog' => [
            'register' => true,
            'sort' => 1,
            'icon' => 'heroicon-o-rectangle-stack',
            'plural-label' => 'Mail Logs',
        ],
    ],

    'sort' => [
        'column' => 'created_at',
        'direction' => 'desc',
    ],
];
