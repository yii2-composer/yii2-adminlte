<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/4
 * Time: 12:36
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\web\ErrorHandler;

class FormField extends Widget
{
    /**
     * @var Form
     */
    public $form;
    public $layout = '{label}{content}{buttons}';
    public $contentlayout = '{input}{help}{error}';
    public $parts = [];
    public $groupOptions = ['class' => 'form-group'];
    public $contentOptions = [];
    public $inputOptions = [];

    public function init()
    {
        parent::init();
        $this->inputOptions['id'] = $this->getId();
        if ($this->form->layout == Form::LAYOUT_TABLELINE) {
            $this->groupOptions = [];
        }
    }

    function __toString()
    {
        try {
            return $this->render($this->getView());
        } catch (\Exception $e) {
            ErrorHandler::convertExceptionToError($e);

            return '';
        }
    }

    public function getView()
    {
        return $this->form->getView();
    }

    public function render($view, $params = [])
    {
        if (!isset($this->parts['{label}'])) {
            $this->parts['{label}'] = "";
        }
        if (!isset($this->parts['{buttons}'])) {
            $this->parts['{buttons}'] = "";
        }
        if (!isset($this->parts['{help}'])) {
            $this->parts['{help}'] = "";
        }
        if (!isset($this->parts['{error}'])) {
            $this->parts['{error}'] = "";
        }
        if (!isset($this->parts['{input}'])) {
            $this->parts['{input}'] = "";
        }
        if (!empty($this->parts['{input}']) || !empty($this->parts['{help}']) || !empty($this->parts['{error}'])) {
            if ($this->form->layout == Form::LAYOUT_HORIZONTAL || $this->form->layout == Form::LAYOUT_TABLELINE) {
                Html::addCssClass($this->contentOptions,
                    'col-sm-' . ($this->form->maxWidth - (empty($this->parts['{label}']) ? 0 : $this->form->labelWidth)));
                $this->contentlayout = Html::tag('div', $this->contentlayout,
                    $this->contentOptions);
            }
            $this->parts['{content}'] = strtr($this->contentlayout, $this->parts);
        } else {
            $this->parts['{content}'] = "";
        }

        return Html::tag('div', strtr($this->layout, $this->parts), $this->groupOptions);
    }

    public function label($content)
    {
        switch ($this->form->layout) {
            case Form::LAYOUT_HORIZONTAL:
                $this->parts['{label}'] = Html::label($content, $this->getId(),
                    ['class' => 'control-label col-sm-' . $this->form->labelWidth]);
                break;
            case Form::LAYOUT_TABLELINE:
                $this->parts['{label}'] = Html::label($content, $this->getId(),
                    [
                        'class' => 'control-label col-sm-' . $this->form->labelWidth,
                        'style' => 'text-align: left;',
                    ]);
                break;
            case Form::LAYOUT_VERTICLE:
                $this->parts['{label}'] = Html::label($content, $this->getId());
                break;
            case Form::LAYOUT_INLINE:
                $this->parts['{label}'] = Html::label($content, $this->getId(),
                    ['style' => 'margin-left:4px;margin-right:4px;']);

                break;
        }

        return $this;
    }

    public function help($content)
    {
        if ($this->form->layout == Form::LAYOUT_INLINE) {
            $this->inputOptions['data-toggle'] = 'tooltip';
            $this->inputOptions['data-original-title'] = $content;
        } else {
            $this->parts['{help}'] = Html::tag('p', $content, ['class' => 'help-block']);
        }

        return $this;
    }

    public function error($content)
    {
        if ($this->form->layout == Form::LAYOUT_INLINE) {
            $this->inputOptions['data-toggle'] = 'tooltip';
            $this->inputOptions['data-original-title'] = $content;
        } else {
            $this->parts['{error}'] = Html::tag('p',
                Html::tag('span', $content, ['class' => 'help-block']), ['class' => 'has-error']);
        }

        return $this;
    }

    public function input($type, $name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::input($type, $name, $value, $options);

        return $this;
    }

    public function input_text($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::input('text', $name, $value, $options);

        return $this;
    }

    public function input_number($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::input('number', $name, $value, $options);

        return $this;
    }

    public function textarea($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        Html::addCssClass($options, 'form-control');
        $this->parts['{input}'] = Html::textarea($name, $value, $options);

        return $this;
    }

    public function checkbox($name, $label, $value, $checked = false, $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $options['label'] = $label;
        $options['value'] = $value;
        $this->parts['{input}'] = Html::tag('div', Html::checkbox($name, $checked, $options),
            ['class' => 'checkbox']);

        return $this;
    }

    public function checkboxgroup($name, $items, $values, $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $html = "";
        $class = (isset($options['inline']) && $options['inline']) ? 'checkbox-inline' : 'checkbox';
        unset($options['inline']);
        $id = $options['id'];
        if ($items) {
            foreach ($items as $key => $item) {
                $options['id'] = $id . '_' . $key;
                $options['label'] = $item['label'];
                $options['value'] = $item['value'];
                $html .= Html::tag('div',
                    Html::checkbox($name, in_array($item['value'], $values), $options),
                    ['class' => $class]);
            }
        }
        $this->parts['{input}'] = $html;

        return $this;
    }

    public function radio($name, $label, $value, $checked = false, $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $options['label'] = $label;
        $options['value'] = $value;
        $this->parts['{input}'] = Html::tag('div', Html::radio($name, $checked, $options),
            ['class' => 'radio']);

        return $this;
    }

    public function radiogroup($name, $items, $value, $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $class = (isset($options['inline']) && $options['inline']) ? 'radio-inline' : 'radio';
        unset($options['inline']);
        $html = "";
        $id = $options['id'];
        if ($items) {
            foreach ($items as $key => $item) {
                $options['id'] = $id . '_' . $key;
                $options['label'] = $item['label'];
                $options['value'] = $item['value'];
                $html .= Html::tag('div', Html::radio($name, ($item['value'] == $value), $options),
                    ['class' => $class]);
            }
        }
        $this->parts['{input}'] = $html;

        return $this;
    }

    public function inputgroup($type,$name,$value,$addon,$right=false,$options=[]){
        $options = ArrayHelper::merge($this->inputOptions, $options);
        
        $contant = Html::beginTag('div',['input-group']);
        if($right){
            $contant .= Html::input($type, $name, $value, $options);
            $contant .= $addon;
        }else{
            $contant.= $addon;
            $contant.= Html::input($type, $name, $value, $options);
        }
        $contant.=Html::endTag('div');
        $this->parts['{input}'] = $contant;
        
        return $this;
    }
    
    public function select($name, $value = '', $items = [], $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        Html::addCssClass($options, 'form-control');
        $this->parts['{input}'] = Html::dropDownList($name, $value, $items, $options);

        return $this;
    }

    public function enhancedselect($name, $value = '', $items = [], $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        Html::addCssClass($options, 'form-control');
        $this->parts['{input}'] = Html::dropDownList($name, $value, $items, $options);
        Widgets::widgetSelect($this->getView(), $options['id'],
            ArrayHelper::getValue($options, 'option', []));

        return $this;
    }

    public function colorpicker($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        Widgets::widgetColorPicker($this->getView(), $options['id']);

        return $this;
    }

    public function switchbutton($name,$checked,$size='normal',$options=[]){
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::checkbox($name,$checked,$options);
        Widgets::widgetSwitchButton($this->getView(), $options['id'],$size);

        return $this;
    }
    
    public function inputmask($name, $type, $format, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        Widgets::widgetInputmask($this->getView(), $options['id'], $type, $format);

        return $this;
    }

    public function timepicker($name, $value = '', $options = [])
    {
        if (!$value) {
            $value = date('H:i:s');
        }
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        Widgets::widgetTimePicker($this->getView(), $options['id']);

        return $this;
    }

    public function yearpicker($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        Widgets::widgetYearPicker($this->getView(), $options['id'], $value);

        return $this;
    }

    public function monthpicker($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        if (isset($options['format'])) {
            $format = $options['format'];
            unset($options['format']);
        } else {
            $format = 'Y-m';
        }
        Widgets::widgetMonthPicker($this->getView(), $options['id'], $value, $format);

        return $this;
    }

    public function datepicker($name, $value = '', $options = [])
    {
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        if (isset($options['format'])) {
            $format = $options['format'];
            unset($options['format']);
        } else {
            $format = 'Y-m-d';
        }
        Widgets::widgetDatePicker($this->getView(), $options['id'], $value, $format);

        return $this;
    }

    public function datetimepicker($name, $value = '', $options = [])
    {
        if (!$value) {
            $value = date('Y-m-d H:i:s');
        }
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] = Html::textInput($name, $value, $options);
        if (isset($options['format'])) {
            $format = $options['format'];
            unset($options['format']);
        } else {
            $format = 'Y-m-d H:i:s';
        }
        Widgets::widgetDateTimePicker($this->getView(), $options['id'], $value, $format);

        return $this;
    }

    public function datetimerangepicker($start_name, $stop_name, $start_value = '', $stop_value = '', $withtime = false, $options = [])
    {
        if ($start_value && ((int)$start_value."" == $start_value)) {
            $start_value = date('Y-m-d H:i:s', $start_value);
        }
        if ($stop_value && ((int)$stop_value."" == $stop_value)) {
            $stop_value = date('Y-m-d H:i:s', $stop_value);
        }
        $options = ArrayHelper::merge($this->inputOptions, $options);
        $this->parts['{input}'] =
            Html::hiddenInput($start_name, $start_value, ['id' => $options['id'] . '_start']) .
            Html::hiddenInput($stop_name, $stop_value, ['id' => $options['id'] . '_stop']) .
            Html::textInput('', $start_value . ' - ' . $stop_value, $options);
        Widgets::widgetDateTimeRangePicker($this->getView(), $options['id'],
            $options['id'] . '_start', $options['id'] . '_stop', $start_value, $stop_value,
            $withtime);

        return $this;
    }

    public function widgets($class, $name, $value, $config = [])
    {
        /* @var $class \yii\base\Widget */
        $config['view'] = $this->form->getView();
        $config['name'] = $name;
        $config['value'] = $value;
        $this->parts['{input}'] = $class::widget($config);

        return $this;
    }

    public function buttons($submit, $reset = '', $options = [])
    {
        $this->parts['{buttons}'] = '';
        switch ($this->form->layout) {
            case Form::LAYOUT_HORIZONTAL:
            case Form::LAYOUT_VERTICLE:
            case Form::LAYOUT_TABLELINE:
                Html::addCssClass($this->groupOptions, 'text-center');
                if ($submit) {
                    $this->parts['{buttons}'] .= Html::submitButton($submit,
                        ['style' => 'margin-right:4px;']);
                }
                if ($reset) {
                    $this->parts['{buttons}'] .= Html::resetButton($reset,
                        ['style' => 'margin-right:4px;']);
                }
                $this->parts['{buttons}'] = Html::tag('div', $this->parts['{buttons}'], $options);
                break;
            case Form::LAYOUT_INLINE:
                if ($submit) {
                    $this->parts['{buttons}'] .= Html::submitButton($submit,
                        ['style' => 'margin-left:4px;margin-right:4px;']);
                }
                if ($reset) {
                    $this->parts['{buttons}'] .= Html::resetButton($reset,
                        ['style' => 'margin-left:4px;margin-right:4px;']);
                }
                break;
        }

        return $this;
    }
}
