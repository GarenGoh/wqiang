<?php
Yii::setAlias('@frontends', dirname(__DIR__) . '/frontends');
define('ADMIN_NAME', 'admin');

$config = [
    'language' => 'zh-CN',
    'modules' => [
        'test' => [
            'class' => 'app\test\Module'
        ],
        ADMIN_NAME => [
            'class' => 'app\module\admin\Admin',
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
        'urlManager' => [
            'enablePrettyUrl'=> true,//使用美化的URL
            //'showScriptName' => false,//是否显示入口脚本
            //'enableStrictParsing' => false,
            //'suffix' => '.html',//后缀，如果设置了此项，那么浏览器地址栏就必须带上.html后缀，否则会报404错误
            'rules' => [
            ],
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
    ]
];

return $config;
?>
