<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/19
 * Time: 22:03
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;
use yii\web\View;

class JqueryAsset extends AssetBundle
{
    public $sourcePath = "@liyifei/adminlte/assets/plugins/jQuery";

    public $js = [
        'jQuery-2.1.4.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}
