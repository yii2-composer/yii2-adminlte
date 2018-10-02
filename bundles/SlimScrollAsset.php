<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/24
 * Time: 09:46
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class SlimScrollAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/slimScroll";

    public $js = [
        'jquery.slimscroll.min.js'
    ];

    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset'
    ];
}
