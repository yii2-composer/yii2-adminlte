<?php
/**
 * User: liyifei
 * Date: 16/10/24
 */

namespace liyifei\adminlte\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class StatusLabel extends Widget
{
    public $type = self::TYPE_SUCCESS;
    public $value;
    public $custom_class = 'status';

    const TYPE_SUCCESS = 1;
    const TYPE_WARNING = 2;
    const TYPE_DANGER = 3;

    public $classes;

    public function init()
    {
        $this->classes = [
            1 => 'label label-success ' . $this->custom_class,
            2 => 'label label-warning ' . $this->custom_class,
            3 => 'label label-danger ' . $this->custom_class,
        ];
    }

    public function run()
    {
        //$labels = $this->type == self::TYPE_ONOFF ? StatusSymbol::$STATUSES_ONOFF : StatusSymbol::$STATUSES_CHECK;
//
//        $labels = [];
//        if ($this->type == static::TYPE_ONOFF) {
//            $labels = StatusSymbol::$STATUSES_ONOFF;
//        } elseif ($this->type == static::TYPE_CHECK) {
//            $labels = StatusSymbol::$STATUSES_CHECK;
//        } elseif ($this->type == static::TYPE_RECOMMEND) {
//            $labels = StatusSymbol::$STATUSES_RECOMMEND;
//        } elseif ($this->type == static::TYPE_TOP) {
//            $labels = StatusSymbol::$STATUSES_TOP;
//        } elseif ($this->type == static::TYPE_NEED) {
//            $labels = StatusSymbol::$STATUSES_NEED;
//        }

        return Html::label($this->value, null, ['class' => $this->classes[$this->type]]);
    }

}
