<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 22:01
 */

namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\GridViewAsset;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

class GridView extends \yii\grid\GridView
{
    public $boxTheme;

    /**
     * @desc box header content
     * @var callable $boxHeader
     */
    public $boxHeader;

    public $layout;

    public function init()
    {
        if (!$this->layout) {
            $this->layout = "<div class='box " . (string)$this->boxTheme . "'>{header}<div class='box-body'>{items}</div><div class='box-footer clearfix'>{summary}{pager}</div></div>";
        }

        parent::init();
    }

    public function run()
    {
        GridViewAsset::register($this->getView());
        parent::run();
    }

    public function renderSummary()
    {
        $this->summaryOptions = ['class' => 'summary pull-left', 'style' => 'margin-top:7px;'];
        return parent::renderSummary();
    }

    public function renderBoxHeader()
    {
        if (is_callable($this->boxHeader)) {
            return '<div class="box-header">' . call_user_func_array($this->boxHeader, []) . '</div>';
        }
    }

    public function renderSection($name)
    {
        if ($name == '{header}') {
            return $this->renderBoxHeader();
        }

        return parent::renderSection($name);
    }

    /**
     * @return string
     */
    public function renderPager()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }
        /* @var $class LinkPager */
        $pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', LinkPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();
        $pager['options'] = ['class' => 'pagination no-margin pull-right'];
        return $class::widget($pager);
    }

}
