<?php
return [
    'bootstrap' => ['bootstrap'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'bootstrap' => [
            'class' => \common\components\BootstrapComponent::class,
        ],
        'bot' => [
            'class' => \SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => '701520782:AAFeFO4pwr5SJWNfLZ-8Ewlw5KrJHhRNM-Q'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
