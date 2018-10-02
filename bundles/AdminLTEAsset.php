<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/18
 * Time: 22:40
 */
namespace liyifei\adminlte\bundles;

use yii\web\AssetBundle;

class AdminLTEAsset extends AssetBundle{
    public $sourcePath = "@liyifei/adminlte/assets/adminlte";
    
    public $theme='skin-blue-light';
    
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
    ];
    
    public $js = [
        'js/app.min.js',
    ];
    
    public $depends = [
        'liyifei\adminlte\bundles\JqueryAsset',
        'liyifei\adminlte\bundles\IEAsset',
        'liyifei\adminlte\bundles\JqueryUIAsset',
        'liyifei\adminlte\bundles\BootstrapAsset',
        'liyifei\adminlte\bundles\FontawesomeAsset',
        'liyifei\adminlte\bundles\IoniconsAsset',
    ];

    public function init()
    {
        parent::init();
        if (!empty($this->theme)) {
            $this->css['theme'] = 'css/skins/' . $this->theme . '.min.css';
        }
    }
    
    public function setTheme($theme){
        $this->theme=$theme;
        if(!empty($this->theme))
            $this->css['theme'] = 'css/skins/' . $this->theme . '.min.css';
        else{
            unset($this->css['theme']);
        }
    }

}
