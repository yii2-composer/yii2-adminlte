<?php
/**
 * User: liyifei
 * Date: 16/12/21
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class LightBoxAsset extends AssetBundle
{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/lightbox";

    public $css = [
        'ekko-lightbox.min.css',
    ];

    public $js = [
        'ekko-lightbox.min.js',
    ];

    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
        'liyifei\adminlte\bundles\JqueryUIAsset',
        'liyifei\adminlte\bundles\BootstrapAsset',
    ];
}
