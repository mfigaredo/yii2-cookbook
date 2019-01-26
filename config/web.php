<?php

use app\cart\storage\SessionStorage;

Yii::$container->setSingleton('app\cart\ShoppingCart');

Yii::$container->set('app\cart\storage\StorageInterface', function() {
    return new SessionStorage(Yii::$app->session, 'primary-cart');
});

Yii::$classMap['OldLibrary'] = '@old/OldLibrary.php';

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@awesome' => '@app/awesome',
        '@old' => '@app/old',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'QVSoln5KvM_DX2Ev_mnSye_CnkZg-zn0',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
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
            // 'useFileTransport' => true,

            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => '15962e17a4579f',
                'password' => 'dadf02d9994c8d',
                'port' => '465',
                'encryption' => 'tls',
            ],

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
        'db2' => require __DIR__ . '/db2.php',
        'db_sakila' => require __DIR__ . '/db_sakila.php',
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'blogpost/<slug>' => 'blog-post/slug',
                'defaultRoute' => '/site/index',
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'datetimeFormat' => 'dd.MM.yyyy hh:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

/* Yii::setAlias('@awesome', '@app/awesome');
Yii::setAlias('@old', '@app/old');
Yii::$classMap['OldLibrary'] = '@old/OldLibrary.php'; */

return $config;
