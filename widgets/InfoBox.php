<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/4
 * Time: 10:59
 */

namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use yii\base\Widget;

class InfoBox extends Widget
{
    public $flat = true;
    public $icon = 'ion ion-ios-gear-outline';
    public $background = 'bg-aqua';
    public $title;
    public $text;
    public $href;

    public function run()
    {
        if ($this->flat) {
            echo Html::beginTag('div', ['class' => 'col-md-3 col-sm-6 col-xs-12']);
            echo Html::beginTag('div', ['class' => 'info-box']);
            echo Html::tag('span', Html::tag('i', '', ['class' => $this->icon]),
                ['class' => 'info-box-icon ' . $this->background]);
            echo Html::beginTag('div', ['class' => 'info-box-content']);
            echo Html::tag('span', $this->title, ['class' => 'info-box-text']);
            echo Html::tag('span', $this->text, ['class' => 'info-box-number']);
            echo Html::endTag('div');
            echo Html::endTag('div');
            echo Html::endTag('div');
        } else {
            echo Html::beginTag('div', ['class' => 'col-lg-3 col-xs-6']);
            echo Html::beginTag('div', ['class' => 'small-box ' . $this->background]);
            echo Html::tag('div', Html::tag('h3', $this->text) . Html::tag('p', $this->title), ['class' => 'inner']);
            echo Html::tag('div', Html::tag('i', '', ['class' => $this->icon]), ['class' => 'icon']);
            if ($this->href)
                echo Html::a('更多详情<i class="fa fa-arrow-circle-right"></i>', $this->href, ['class' => 'small-box-footer']);
            echo Html::endTag('div');
            echo Html::endTag('div');
        }
    }

}
