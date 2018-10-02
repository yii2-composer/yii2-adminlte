<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 15:24
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;
use yii\web\View;

class IEAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/ie";
    
    public $js =[
        'html5shiv.min.js',
        'respond.min.js'
    ];

    public $jsOptions = [
        'condition' => 'lt IE 9',
        'position'=>View::POS_HEAD
    ];
}
