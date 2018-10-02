<?php
/**
 * User: liyifei
 * Date: 16/7/4
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use yii\bootstrap\Widget;

/**
 * Class SortableList
 * @package liyifei\adminlte\widgets
 */
class SortableList extends Widget
{
    /**
     * @var array
     *
     * [
     *  'id'=>'',
     *  'label'=>'',
     *  'deletable'=>'',
     * ]
     */
    public $items = [];
    public $callback = '';
    public $options = [];

    public function run()
    {
        $lis = [];
        $handler = '<span class="handle ui-sortable-handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span>';
        $tool = '<div class="tools"><i class="fa fa-trash-o delete"></i></div>';
        if (count($this->items) > 0) {
            foreach ($this->items as $item) {
                $lis[] = Html::tag('li', $handler . Html::tag('span', $item['label'], ['class' => 'text']) . (isset($item['deletable']) && $item['deletable'] ? $tool : ''), ['id' => $this->id . '_' . $item['id'], 'data-id' => $item['id']]);
            }
        }
        
        Html::addCssClass($this->options, ['todo-list', 'ui-sortable']);
        $this->options['id']=$this->id;
        $html = Html::tag('ul', implode("\n", $lis), $this->options);
        
        $js = '
$("#' . $this->id . '").sortable({
     placeholder: "sort-highlight",
     handle: ".handle",
     forcePlaceholderSize: true,
     zIndex: 999999,
     update:function(e,ui){
        console.log($(e.target).sortable("toArray",{attribute:"data-id"}));
        ' . ($this->callback ? 'eval(' . $this->callback . '($(e.target).sortable("toArray",{attribute:"data-id"})));' : '') . '
     }
}).disableSelection();
$("#' . $this->id . ' i.delete").on("click",function(e){$(e.target).parents("li").remove()});
                             ';
        $this->getView()->registerJs($js);
        
        return $html;
    }
}
