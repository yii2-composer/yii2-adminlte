<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 10:56
 */
namespace liyifei\adminlte\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class NavBar extends Widget{
    public function init() {
        parent::init();
        echo Html::beginTag('nav', ['class'=>'navbar navbar-static-top','role'=>'navigation']);
        $this->renderToggleButton();
        echo Html::beginTag('div',['class'=>'navbar-custom-menu']);
    }

    public function run() {
        echo Html::endTag('div');
        echo Html::endTag('nav');
    }

    protected function renderToggleButton() {
        echo Html::beginTag('a',['href'=>'#','class'=>'sidebar-toggle','data-toggle'=>'offcanvas','role'=>'button']);
        echo '<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';
        echo Html::endTag('a');
    }

}
