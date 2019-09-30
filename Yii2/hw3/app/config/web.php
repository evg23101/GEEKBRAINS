<?php

use app\components\contacts\LoggerNotification;
use app\components\contacts\Notification;
use app\components\LoggerConsole;
use app\components\NotificationComponent;
use yii\i18n\PhpMessageSource;
use yii\mail\MailerInterface;
use yii\rest\UrlRule;
use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__ . '/db_locale.php') ?
    (require __DIR__ . '/db_locale.php') :
    (require __DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'name' => 'Календарь событий',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
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
        'rbac'=>['class'=>\app\components\RbacComponent::class],
        'activity' => [
            'class' => \app\components\ActivityComponent::class,
            'classModel' => app\models\Activity::class,
        ],
        'auth'=>['class'=>\app\components\AuthComponent::class ],
        'dao' => [
            'class'=>\app\components\DaoComponent::class
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'QtX5mlFe308lLhG0aiJ6wHefPjAoeVN_',
            'parsers' => [
                'application/json' => JsonParser::class
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'i18n'=>[
            'translations' => [
                'app*' => [
                    'class' => PhpMessageSource::class,
                    'fileMap' => [
                        'app'=>'app.php',
                        'app/rbac'=>'rbac.php'
                    ]
                ]
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'new'=>'activity/create',
                'activity/new'=>'activity/create',
                '<controller>/view/<id:\w+>'=>'activity/view',
                'event/<action>'=>'activity/<action>',
                [
                    'class'=> UrlRule::class,
                    'controller' => 'api',
                    'pluralize' => false
                ]
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
