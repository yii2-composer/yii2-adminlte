<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/5
 * Time: 21:22
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class MorrisAsset extends AssetBundle
{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/morris";

    public $css = [
        'morris.css',
    ];

    public $js = [
        'raphael-min.js',
        'morris.min.js',
    ];
    
    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
        'liyifei\adminlte\bundles\JqueryUIAsset',
    ];
}
