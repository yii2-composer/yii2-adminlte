<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/20
 * Time: 23:09
 */
namespace liyifei\adminlte\widgets;

use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class Alert extends Widget{
    const TYPE_ERROR="error";
    const TYPE_DANGER="danger";
    const TYPE_SUCCESS="success";
    const TYPE_INFO="info";
    const TYPE_WARNING="warning";
    
    private $alertTypes = [
        'error' => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fa fa-ban"></i>',
        ],
        'danger' => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fa fa-ban"></i>',
        ],
        'success' => [
            'class' => 'alert-success',
            'icon' => '<i class="icon fa fa-check"></i>',
        ],
        'info' => [
            'class' => 'alert-info',
            'icon' => '<i class="icon fa fa-info"></i>',
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => '<i class="icon fa fa-warning"></i>',
        ],
    ];

    public function run() {
        $session = Yii::$app->getSession();
        if($session)
        {
            $html="";
            $flashes = $session->getAllFlashes();
            if(!empty($flashes)){
                foreach ($flashes as $type => $data) {
                    if(!isset($this->alertTypes[$type]))
                        $type=self::TYPE_INFO;
                    if(is_array($data))
                        $data=nl2br(Html::encode(implode("\n",$data)));
                    $html= Html::beginTag('div',['class'=>'alert alert-dismissable '.$this->alertTypes[$type]['class']]);
                    $html .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                    $html .= Html::tag('h4',$this->alertTypes[$type]['icon'].$type);
                    $html .= $data;
                    $html .= Html::endTag('div');
                    $session->removeFlash($type);
                }
            }
            return $html;
        }
        return "";
    }

}
