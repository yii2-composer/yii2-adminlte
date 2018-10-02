<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/22
 * Time: 22:33
 */
namespace liyifei\adminlte;

use Yii;
use yii\helpers\BaseHtml;
use yii\helpers\Url;
use yii\web\Request;

class Html extends BaseHtml
{
    public static function aButton($text, $url = null, $options = [])
    {
        self::addCssClass($options, 'btn');
        if ($url !== null) {
            $options['href'] = Url::to($url);
        }

        return parent::a($text, $url, $options);
    }

    public static function button($content = 'Button', $options = [])
    {
        self::addCssClass($options, 'btn');

        return parent::button($content, $options);
    }

    public static function submitButton($content = 'Submit', $options = [])
    {
        self::addCssClass($options, 'btn btn-primary');

        return parent::submitButton($content, $options);
    }

    public static function resetButton($content = 'Reset', $options = [])
    {
        self::addCssClass($options, 'btn btn-warning');

        return parent::resetButton($content, $options);
    }

    public static function input($type, $name = null, $value = null, $options = [])
    {
        if ($type != 'checkbox' && $type != 'radio') {
            self::addCssClass($options, 'form-control');
        }

        return parent::input($type, $name, $value, $options);
    }

    public static function submitInput($label = 'Submit', $options = [])
    {
        self::addCssClass($options, 'btn btn-primary');

        return parent::submitInput($label, $options);
    }

    public static function resetInput($label = 'Reset', $options = [])
    {
        self::addCssClass($options, 'btn btn-warning');

        return parent::resetInput($label, $options);
    }

    public static function textInput($name, $value = null, $options = [])
    {
        self::addCssClass($options, 'form-control');

        return parent::textInput($name, $value, $options);
    }

    public static function activeInput($type, $model, $attribute, $options = [])
    {
        self::addCssClass($options, 'form-control');

        return parent::activeInput($type, $model, $attribute, $options);
    }

    public static function activeTextInput($model, $attribute, $options = [])
    {
        self::addCssClass($options, 'form-control');

        return parent::activeTextInput($model, $attribute, $options);
    }

    public static function staticControl($value, $options = [])
    {
        static::addCssClass($options, 'form-control-static');
        $value = (string)$value;
        if (isset($options['encode'])) {
            $encode = $options['encode'];
            unset($options['encode']);
        } else {
            $encode = true;
        }

        return static::tag('p', $encode ? static::encode($value) : $value, $options);
    }

    public static function activeStaticControl($model, $attribute, $options = [])
    {
        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        } else {
            $value = static::getAttributeValue($model, $attribute);
        }

        return static::staticControl($value, $options);
    }

    public static function beginForm($action = '', $method = 'post', $hiddenFields = [], $options = [])
    {
        $action = Url::to($action);

        $hiddenInputs = [];

        $request = Yii::$app->getRequest();
        if ($request instanceof Request) {
            if (strcasecmp($method, 'get') && strcasecmp($method, 'post')) {
                // simulate PUT, DELETE, etc. via POST
                $hiddenInputs[] = static::hiddenInput($request->methodParam, $method);
                $method = 'post';
            }
            if ($request->enableCsrfValidation && !strcasecmp($method, 'post')) {
                $hiddenInputs[] = static::hiddenInput($request->csrfParam,
                    $request->getCsrfToken());
            }
        }

        if (!strcasecmp($method, 'get') && ($pos = strpos($action, '?')) !== false) {
            foreach (explode('&', substr($action, $pos + 1)) as $pair) {
                if (($pos1 = strpos($pair, '=')) !== false) {
                    $name = urldecode(substr($pair, 0, $pos1));
                    if ($hiddenFields && in_array($name, $hiddenFields)) {
                        $hiddenInputs[] = static::hiddenInput(
                            $name,
                            urldecode(substr($pair, $pos1 + 1))
                        );
                    }
                } else {
                    $name = urldecode($pair);
                    if ($hiddenFields && in_array($name, $hiddenFields)) {
                        $hiddenInputs[] = static::hiddenInput($name, '');
                    }
                }
            }
            $action = substr($action, 0, $pos);
        }

        $options['action'] = $action;
        $options['method'] = $method;
        $form = static::beginTag('form', $options);
        if (!empty($hiddenInputs)) {
            $form .= "\n" . implode("\n", $hiddenInputs);
        }

        return $form;
    }
}
