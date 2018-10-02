<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/24
 * Time: 23:13
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class GridViewAsset extends AssetBundle{
    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
        'liyifei\adminlte\bundles\JqueryUIAsset',
        'liyifei\adminlte\bundles\BootstrapAsset',
        'yii\grid\GridViewAsset'
    ];
}
