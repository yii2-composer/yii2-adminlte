<?php
/**
 * User: liyifei
 * Date: 16/4/10
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\ActionBtnAsset;
use liyifei\adminlte\Html;
use yii\base\NotSupportedException;
use yii\base\Widget;

class ActionButton extends Widget
{
    const TYPE_ACT = 'action_act';
    const TYPE_DELETE = 'action_delete';
    const TYPE_ENABLE = 'action_enable';
    const TYPE_DISABLE = 'action_disable';

    public $type;
    public $text;
    public $data_id;
    public $data_method;
    public $data_data;
    public $data_confirm;
    public $data_action;
    public $data_href;
    public $data_target;
    public $data_callback;
    public $style;

    public function run()
    {
        ActionBtnAsset::register($this->getView());
        $options = [];
        $options['class'] = 'btn-xs ' . $this->type;
        if ($this->style) {
            $options['style'] = $this->style;
        }
        switch ($this->type) {
            case self::TYPE_ACT:
                $options['data-confirm']=$this->data_confirm;
                $options['data-method'] = $this->data_method;
                $options['data-data'] = $this->data_data;
                $options['data-href'] = $this->data_href;
                $options['data-target'] = $this->data_target;
                $options['data-callback'] = $this->data_callback;
                break;
            case self::TYPE_DELETE:
                $options['data-id'] = $this->data_id;
                $options['data-action'] = $this->data_action;
                $options['data-href'] = $this->data_href;
                $options['data-target'] = $this->data_target;
                break;
            case self::TYPE_ENABLE:
            case self::TYPE_DISABLE:
                $options['data-id'] = $this->data_id;
                $options['data-action'] = $this->data_action;
                $options['data-href'] = $this->data_href;
                $options['data-target'] = $this->data_target;
                $options['data-callback'] = $this->data_callback;
                break;
            default:
                throw new NotSupportedException($this->type . ' is not supported');
        }

        return Html::aButton($this->text, "#", $options);
    }

}
