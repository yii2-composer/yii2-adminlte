<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 11:01
 */

namespace liyifei\adminlte\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Nav extends Widget
{
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];
    public $encodeLabels = true;
    public $params;

    public function run()
    {
        return $this->renderItems();
    }

    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), ['class' => 'nav navbar-nav']);
    }

    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }

        $type = ArrayHelper::getValue($item, 'type', '');
        if ($type != 'notification' && !isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        if ($type == 'notification') {
            $label = '<i class="fa fa-bell-o"></i>';
        } else {
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        }
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if ($items !== null && is_array($items)) {
            if ($type == 'notification') {
                if ($item['count'] > 0) {
                    $label .= '<span class="label label-warning">' . $item['count'] . '</span>';
                }
            } else {
                $label .= '<b class="caret"></b>';
            }

            Html::addCssClass($options, ['dropdown']);
            Html::addCssClass($linkOptions, ['dropdown-toggle']);
            $linkOptions['data-toggle'] = 'dropdown';
            $items = $this->renderDropdown($items, $item);
        } else {
            $items = '';
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }

    protected function renderDropdown($items, $parentItem)
    {
        $lines = [];
        foreach ($items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if (is_string($item)) {
                $lines[] = $item;
                continue;
            }
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $linkOptions['tabindex'] = '-1';
            $url = array_key_exists('url', $item) ? $item['url'] : null;
            if ($url === null) {
                $content = $label;
                Html::addCssClass($itemOptions, ['widget' => 'dropdown-header']);
            } else {
                $content = Html::a($label, $url, $linkOptions);
            }

            $lines[] = Html::tag('li', $content, $itemOptions);
        }

        return Html::tag('ul', implode("\n", $lines), ['class' => 'dropdown-menu']);
    }

}
