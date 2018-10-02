<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 14:09
 */
namespace liyifei\adminlte\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class SideBar extends Widget{
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - icon: string, optional, the fontawesome icon before label
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
    public $actives = [];
    public $encodeLabels = true;
    public $params;
    
    public function run(){
        if(isset($this->items['actives']))
            unset($this->items['actives']);
        return $this->renderItems();
    }
    
    public function renderItems(){
        $items=[];
        foreach($this->items as $key=>$item){
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            if(in_array($key,$this->actives))
                $item['active']=true;
            $items[] = $this->renderItem($item);
        }
        
        return Html::tag('ul',implode("\n",$items),['class'=>'sidebar-menu']);
    }
    
    public function renderItem($item){
        if(is_string($item))
            return $item;
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $icon = isset($item['icon'])?Html::tag('i','',['class'=>$item['icon']]):'';
        $label = $icon.Html::tag('span', $label);
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $active =ArrayHelper::getValue($item,'active',false);
        if($active)
            Html::addCssClass($options,'active');
        if ($items !== null && is_array($items)) {
            $url='#';
            $label=$label.'<i class="fa fa-angle-left pull-right"></i>';
            $items = $this->renderSubItems($items,$item);
        }else{
            $items='';
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions). $items , $options);
    }
    
    protected function renderSubItems($items,$parentItem){
        $lines = [];
        foreach ($items as $key=>$item) {
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
            $icon = isset($item['icon']) ? Html::tag('i', '', ['class' => $item['icon']]) : '';
            $label = $icon.Html::tag('span', $label);
            $itemOptions = ArrayHelper::getValue($item, 'options', []);
            $url = ArrayHelper::getValue($item, 'url', '#');
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            $active = ArrayHelper::getValue($item, 'active', false);
            if ($active || in_array($key,$this->actives))
                Html::addCssClass($itemOptions, 'active');
            $subitems = ArrayHelper::getValue($item, 'items');
            if ($subitems !== null && is_array($subitems)) {
                $url='#';
                $label = $label . '<i class="fa fa-angle-left pull-right"></i>';
                $subitems = $this->renderSubItems($subitems, $item);
            }
            else {
                $subitems = '';
            }

            $lines[] = Html::tag('li', Html::a($label, $url, $linkOptions) . $subitems, $itemOptions);
        }

        return Html::tag('ul', implode("\n", $lines), ['class' => 'treeview-menu']);
    }
}
