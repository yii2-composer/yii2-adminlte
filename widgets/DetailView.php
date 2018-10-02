<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 22:03
 */
namespace liyifei\adminlte\widgets;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class DetailView extends \yii\widgets\DetailView{
    
    public function run() {
        echo Html::beginTag('div',['class'=>'box']);
        echo Html::beginTag('div',['class'=>'box-body no-padding table-responsive']);
        echo Html::beginTag('table',['class'=>'table table-striped table-bordered']);
        $rows = [];
        $i = 0;
        foreach ($this->attributes as $attribute) {
            $rows[] = $this->renderAttribute($attribute, $i++);
        }
        echo Html::tag('tbody',implode("\n",$rows));
        echo Html::endTag('table');
        echo Html::endTag('div');
        echo Html::endTag('div');
    }

}
