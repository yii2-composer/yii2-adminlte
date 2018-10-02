<?php
/**
 * User: liyifei
 * Date: 16/3/14
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class MomentAsset extends AssetBundle
{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/moment";

    public $js = [
        'moment-with-locales.js'
    ];

    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
    ];
}
