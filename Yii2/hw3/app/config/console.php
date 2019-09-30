<?php

use app\components\contacts\LoggerNotification;
use app\components\contacts\Notification;
use app\components\LoggerConsole;
use app\components\NotificationComponent;
use yii\mail\MailerInterface;

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db_locale.php') ?
    (require __DIR__ . '/db_locale.php') :
    (require __DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'container' => [
        'singletons'=>[
            LoggerNotification::class=>['class'=> LoggerConsole::class],
            Notification::class=>['class'=> NotificationComponent::class],
            MailerInterface::class=>function(){
                return Yii::$app->mailer;
            }
        ],
        'definitions'=>[]
    ],
    'components' => [
        'authManager'=> [
            'class'=>'yii\rbac\DbManager'
        ],

        'activity' => [
            'class' => \app\components\ActivityComponent::class,
            'classModel' => app\models\Activity::class,
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'galkineo@yadex.ru',
                'password' => '11235813w',
                'port' => '587',
                'encryption' => 'tls'
            ]
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
