<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/2
 * Time: 23:09
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\ActionBtnAsset;
use liyifei\adminlte\Html;
use yii\base\Widget;
use yii\data\Pagination;
use yii\widgets\LinkPager;

class BoxTable extends Widget{
    public $boxOptions=[];

    public function init()
    {
        ActionBtnAsset::register($this->getView());
        Html::addCssClass($this->boxOptions,'box');
        echo Html::beginTag('div',$this->boxOptions);
    }

    public function run()
    {
        echo Html::endTag('div');
    }

}
