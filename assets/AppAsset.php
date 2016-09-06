<?php

namespace app\assets;

use yii\helpers\Html;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/select2.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/select2.min.js',
        'js/main.js',
    ];
    public $jsOptions = [
         'position'=> View::POS_HEAD,
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
