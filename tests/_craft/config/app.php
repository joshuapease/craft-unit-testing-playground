<?php

use craft\helpers\App;

return [
    'id' => App::env('APP_ID') ?: 'CraftCMS',
    'modules' => [
        'craftunit' => [
            'class' => \modules\craftunit\Module::class,
            'components' => [
                'nav' => [
                    'class' => \modules\craftunit\services\Nav::class,
                ],
            ],
        ],
    ],
    'bootstrap' => ['craftunit'],
];
