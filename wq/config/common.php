<?php
Yii::setAlias('@frontend', dirname(__DIR__) . '/frontend');
define('ADMIN_NAME', 'admin');

$config = [
    'language' => 'zh-CN',
    'modules' => [
        /*'test' => [
            'class' => 'app\test\Module'
        ],*/
        ADMIN_NAME => [
            'class' => 'app\module\admin\Admin',
        ],
        'api' => [
            'class' => 'app\module\api\Api',
        ],
    ],
    'params' => require(__DIR__ . '/params.php'),
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.exmail.qq.com',//每种邮箱的host配置不一样
                'username' => 'wu.qiang@sdk.cn',
                'password' => '46663931W.q',
                'port' => '465',
                'encryption' => 'ssl',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'userService' => [
            'class' => 'app\components\UserService'
        ],
        'articleService' => [
            'class' => 'app\components\ArticleService'
        ],
        'fileService' => [
            'class' => 'app\components\FileService'
        ],
        'advertService' => [
            'class' => 'app\components\AdvertService'
        ],
    ]
];

return $config;
?>
