<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/28
 * Time: 22:21
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class SwitchButtonAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/bootstrap-switch";

    public $css = [
        'bootstrap-switch.min.css'
    ];

    public $js = [
        'bootstrap-switch.min.js'
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
