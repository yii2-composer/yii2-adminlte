<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/19
 * Time: 22:01
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class FontawesomeAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/fontawesome";
    
    public $css = [
        'css/font-awesome.min.css',
    ];
}
