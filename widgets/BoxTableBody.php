<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/4
 * Time: 21:04
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\Html;
use yii\base\Widget;
use yii\data\Pagination;
use yii\widgets\LinkPager;

class BoxTableBody extends Widget
{
    /**
     * @var Pagination
     */
    public $pagination;
    /**
     * @var array
     */
    public $header = [];
    public $tableOptions = ['class' => 'table table-striped table-bordered'];

    public function init()
    {
        echo Html::beginTag('div', ['class' => 'box-body table-responsive']);
        echo Html::beginTag('table', $this->tableOptions);
        if ($this->header) {
            echo Html::tag('thead',
                '<tr><th nowrap>' . implode("</th>\n<th nowrap>", $this->header) . '</th></tr>');
        }
        echo Html::beginTag('tbody');
        if ($this->pagination && $this->pagination->totalCount == 0) {
            echo Html::tag('tr', '<td colspan="10"><div class="empty">无数据</div></td>');
        }
    }

    public function run()
    {
        echo Html::endTag('tbody');
        echo Html::endTag('table');
        echo Html::endTag('div');
        //footer
        if ($this->pagination) {
            echo Html::beginTag('div', ['class' => 'box-footer with-border']);
            echo Html::tag('div', '共' . $this->pagination->totalCount . '条记录',
                ['class' => 'summary pull-left', 'style' => 'margin-top: 7px;']);
            echo LinkPager::widget([
                'pagination' => $this->pagination,
                'options' => ['class' => 'pagination no-margin pull-right'],
            ]);
            echo Html::endTag('div');
        }
    }

}
