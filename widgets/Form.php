<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/3
 * Time: 23:16
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;

class Form extends Widget
{
    const LAYOUT_VERTICLE = "default";
    const LAYOUT_HORIZONTAL = "horizontal";
    const LAYOUT_INLINE = "inline";
    const LAYOUT_TABLELINE = "tableline";

    public $layout = self::LAYOUT_VERTICLE;
    public $action = '';
    public $method = 'post';
    public $hiddenFields = [];
    public $options = [];
    public $labelWidth = 2;
    public $maxWidth = 9;

    public function init()
    {
        if (!in_array($this->layout, [
            self::LAYOUT_VERTICLE,
            self::LAYOUT_HORIZONTAL,
            self::LAYOUT_INLINE,
            self::LAYOUT_TABLELINE,
        ])
        ) {
            throw new InvalidConfigException('Invalid layout type: ' . $this->layout);
        }

        if ($this->layout !== self::LAYOUT_VERTICLE || $this->layout !== self::LAYOUT_TABLELINE) {
            Html::addCssClass($this->options, 'form-' . ($this->layout==self::LAYOUT_TABLELINE?self::LAYOUT_HORIZONTAL:$this->layout));
        }
        echo Html::beginForm($this->action, $this->method, $this->hiddenFields, $this->options);
    }

    public function run()
    {
        echo Html::endForm();
    }

    /**
     * @param $options array
     * @return FormField
     * @throws InvalidConfigException
     */
    public function field($options = [])
    {
        $options['class'] = FormField::className();
        $options['form'] = $this;

        return Yii::createObject($options);
    }
}
