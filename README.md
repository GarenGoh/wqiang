wqiang--一个简单的个人博客.
=========================

这是一个由Yii2写的个人博客;服务器使用的阿里云虚拟主机，所以调整了入口脚本的位置,其它Yii框架成员位于 wq 目录;使用MySQL数据库.


怎样使用此项目:
-------------

首先你需要进入你的项目目录,执行:

    git clone git@github.com:GarenGoh/wqiang.git

然后进入yii框架根目录并使用composer安装yii2框架及依赖:

    cd wqiang/wq
    composer install  //我的 composer 是全局安装的

配置数据库:

你需要自行添加数据库文件 `wqiang/wq/config/config.php`,大致内容如下:

```php
<?php
// 生产服务器上注释掉以下两行
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

return [
    'components' => [
        'db' => [   //数据库配饰参照yii2框架
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host= ;dbname= ',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,// 启用美化的URL
            'enableStrictParsing' => false,
            'showScriptName' => false,//隐藏index,在阿里虚拟主机上,此行应该被注释掉.
            //'suffix' => '.html',//后缀，如果设置了此项，那么浏览器地址栏就必须带上.html后缀，否则会报404错误
            'rules' => [
            ],
        ],
        'userService' => [
            'rootIds' => [8, 12]  //设置管理员id,这些id的用户可以进入后台.
        ]
    ]
];
```
前端配置,以此执行:

     cd frontend
     npm install --save-dev
     bower install --save-dev
     gulp build

创建MySQL数据表(在wq目录中操作):

    cd ..
    yii migrate

OK!

新手作品,如有 Bugs,请多多指教!([查看项目实例](http://www.wqiang.net))
