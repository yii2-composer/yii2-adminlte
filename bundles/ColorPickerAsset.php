<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 23:18
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class ColorPickerAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/colorpicker";

    public $css = [
        'bootstrap-colorpicker.min.css'
    ];

    public $js = [
        'bootstrap-colorpicker.min.js',
    ];

    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
        'liyifei\adminlte\bundles\JqueryUIAsset',
        'liyifei\adminlte\bundles\BootstrapAsset',
        'liyifei\adminlte\bundles\FontawesomeAsset',
        'liyifei\adminlte\bundles\IoniconsAsset',
    ];
}
