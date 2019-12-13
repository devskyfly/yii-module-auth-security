<?php
$components = require __DIR__ . '/componets/config.php';
$modules = require __DIR__ . '/modules/config.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@app' => dirname(__DIR__),
        '@frontend' => dirname(__DIR__),
    ],
    'components' => array_merge($components, []),
    'modules' => array_merge($modules, [])
];

return $config;
