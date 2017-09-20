<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';      // 指定包含资源包中资源文件并可Web访问的目录(可使用路径别名)

    public $baseUrl = '@web';           // 指定对应到basePath目录的URL(可使用路径别名)

    public $css = [                     // 包含CSS资源文件数组
        'css/site.css',
    ];

    public $cssOptions = [              // 当调用yii\web\View::registerCssFile()注册该包 每个 css文件时， 指定传递到该方法的选项
        'position' => \yii\web\View::POS_HEAD,  // 指定CSS文件在页面头部加载
    ];

    public $js = [                      // 包含JS资源文件数组

    ];

    public $jsOptions = [               //  当调用yii\web\View::registerJsFile()注册该包 每个 JavaScript文件时， 指定传递到该方法的选项
        'position' => \yii\web\View::POS_END,    // 指定JS文件在页面底部加载
    ];

    public $depends = [                 // 资源依赖
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
