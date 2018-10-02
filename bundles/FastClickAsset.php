<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/24
 * Time: 09:47
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class FastClickAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/fastclick";

    public $js = [
        'fastclick.min.js'
    ];

    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset'
    ];
}
