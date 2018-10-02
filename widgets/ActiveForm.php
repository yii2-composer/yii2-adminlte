<?php
/**
 * Project: qianfan-newmedia
 * User: liyifei
 * Date: 16/1/8
 * Time: 10:40
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\JqueryAsset;
use liyifei\adminlte\Html;
use yii\base\InvalidConfigException;

class ActiveForm extends \yii\widgets\ActiveForm
{
    const LAYOUT_VERTICLE = "default";
    const LAYOUT_HORIZONTAL = "horizontal";
    const LAYOUT_INLINE = "inline";

    public $validateOnChange = false;
    public $validateOnBlur = false;
    public $enableClientValidation = false;
    public $enableAjaxValidation = false;
    public $enableClientScript = false;

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'liyifei\adminlte\widgets\ActiveField';
    /**
     * @var array HTML attributes for the form tag. Default is `['role' => 'form']`.
     */
    public $options = ['role' => 'form'];
    /**
     * @var string the form layout. Either 'default', 'horizontal' or 'inline'.
     * By choosing a layout, an appropriate default field configuration is applied. This will
     * render the form fields with slightly different markup for each layout. You can
     * override these defaults through [[fieldConfig]].
     * @see \yii\bootstrap\ActiveField for details on Bootstrap 3 field configuration
     */
    public $layout = 'default';

    /**
     * @inheritdoc
     */
    public function init()
    {
        JqueryAsset::register($this->getView());
        if (!in_array($this->layout, ['default', 'horizontal', 'inline'])) {
            throw new InvalidConfigException('Invalid layout type: ' . $this->layout);
        }

        if ($this->layout !== 'default') {
            Html::addCssClass($this->options, 'form-' . $this->layout);
        }
        parent::init();
    }

    /**
     * @inheritdoc
     * @return ActiveField the created ActiveField object
     */
    public function field($model, $attribute, $options = [])
    {
        return parent::field($model, $attribute, $options);
    }

    public function submit()
    {
        return Html::tag('div', Html::tag('div', Html::submitButton('提交', ['class' => 'btn btn-primary'])), ['class' => 'form-group text-center']);
    }
}
