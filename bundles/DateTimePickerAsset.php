<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 23:19
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class DateTimePickerAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/datetimepicker";

    public $css = [
        'css/bootstrap-datetimepicker.min.css'
    ];

    public $js = [
        'js/bootstrap-datetimepicker.min.js'
    ];

    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
        'liyifei\adminlte\bundles\JqueryUIAsset',
        'liyifei\adminlte\bundles\BootstrapAsset',
        'liyifei\adminlte\bundles\FontawesomeAsset',
        'liyifei\adminlte\bundles\IoniconsAsset',
        'liyifei\adminlte\bundles\MomentAsset'
    ];
}
