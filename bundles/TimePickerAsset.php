<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 23:20
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class TimePickerAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/timepicker";

    public $css = [
        'css/bootstrap-timepicker.min.css'
    ];

    public $js = [
        'js/bootstrap-timepicker.min.js',
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
