<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/4
 * Time: 00:02
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use yii\base\Widget;

class BoxDetail extends Widget
{
    public $header;
    public $boxOptions = [];

    public function init()
    {
        Html::addCssClass($this->boxOptions, 'box');
        echo Html::beginTag('div', $this->boxOptions);
        if ($this->header) {
            echo Html::tag('div', '<h3 class="box-title">' . $this->header . '</h3>',
                ['class' => 'box-header']);
        }
        echo Html::beginTag('div', ['class' => 'box-body']);
        echo Html::beginTag('table', ['class' => 'table table-striped table-bordered detail-view']);
        echo Html::beginTag('tbody');
    }

    public function run()
    {
        echo Html::endTag('tbody');
        echo Html::endTag('table');
        echo Html::endTag('div');
        echo Html::endTag('div');
    }
}
