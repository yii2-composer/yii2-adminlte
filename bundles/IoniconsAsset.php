<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/19
 * Time: 22:01
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class IoniconsAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/ionicons";
    
    public $css = [
        'css/ionicons.min.css',
    ];
}
