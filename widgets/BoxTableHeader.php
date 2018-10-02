<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/4
 * Time: 21:04
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use yii\base\Widget;

class BoxTableHeader extends Widget
{
    public function init()
    {
        echo Html::beginTag('div', ['class' => 'box-header with-border']);
    }

    public function run()
    {
        echo Html::endTag('div');
    }

}
