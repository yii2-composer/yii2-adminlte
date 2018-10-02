<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 23:21
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class SelectAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/select2";

    public $css = [
        'select2.min.css'
    ];

    public $js = [
        'select2.min.js',
        'i18n/zh-CN.js'
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
