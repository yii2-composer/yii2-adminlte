<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 14:02
 */
namespace liyifei\adminlte;

use liyifei\base\controllers\ViewController;
use Yii;
use yii\web\Controller;
use yii\web\Response;

abstract class AdminLTEController extends ViewController
{
    const LAYOUT_MAIN = '@liyifei/adminlte/views/layouts/main';
    const LAYOUT_SIMPLE = '@liyifei/adminlte/views/layouts/simple';

    const PARAMS_NAVBAR = "navbar";
    const PARAMS_SIDEBAR = "sidebar";
    const PARAMS_SIDEBAR_ACTIVES = "actives";
    const PARAMS_BREADCRUMBS = "breadcrumbs";
    const PARAMS_BODY = "body";

    public $layout = self::LAYOUT_MAIN;
    public $theme = 'skin-blue-light';
    public $assetUrl = '';

    public function init()
    {
        parent::init();

        $this->getView()->params[self::PARAMS_NAVBAR] = $this->getNavbar();
        $this->getView()->params[self::PARAMS_SIDEBAR] = $this->getSidebar();
    }

    /**
     * @return []
     */
    abstract protected function getNavbar();

    /**
     * @return []
     */
    abstract protected function getSidebar();

    public function setSidebarActives($actives = [])
    {
        $this->getView()->params[self::PARAMS_SIDEBAR_ACTIVES] = $actives;
    }

    public function setBreadcrumbs($breadcrumbs = [])
    {
        $this->getView()->params[self::PARAMS_BREADCRUMBS] = $breadcrumbs;
    }

    protected function setBodyOptions($options = [])
    {
        $this->getView()->params[self::PARAMS_BODY] = $options;
    }
}
