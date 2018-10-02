<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/1/24
 * Time: 23:48
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class InputMaskAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/input-mask";

    public $js = [
        'jquery.inputmask.bundle.min.js',
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
