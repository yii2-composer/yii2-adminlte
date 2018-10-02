<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/19
 * Time: 22:01
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/bootstrap";
    
    public $css = [
        'css/bootstrap.min.css',
    ];

    public $js = [
        'js/bootstrap.min.js',
    ];
}
