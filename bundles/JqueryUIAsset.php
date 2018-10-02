<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/19
 * Time: 22:03
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class JqueryUIAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/jQueryUI";

    public $js = [
        'jquery-ui.min.js',
    ];
}
