<?php
/**
 * User: liyifei
 * Date: 16/12/21
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\LightBoxAsset;
use liyifei\adminlte\Html;
use yii\base\Widget;

class LightBox extends Widget
{
    public $images = [];

    public $thumbsize = 100;

    public $imagestyle = '';
    
    public $imageclass = '';

    public function init()
    {
        parent::init();
        $this->imagestyle = 'display:inline-block;height:' . $this->thumbsize . 'px;width:' . $this->thumbsize . 'px;margin:10px;';
    }

    public function run()
    {
        LightBoxAsset::register($this->getView());

        $html = '';
        $html .= Html::beginTag('div', ['id' => $this->getId()]);
        foreach ($this->images as $key => $image) {
            $htmlimage = Html::img($image['thumb'], ['class'=>$this->imageclass,'style' => $this->imagestyle]);
            $html .= Html::a($htmlimage, $image['origin'], ['data-toggle' => 'lightbox', 'data-width' => $image['width'], 'data-height' => $image['height'], 'data-gallery' => 'gallery_' . $this->getId(), 'data-type' => 'image']);
        }
        $html .= Html::endTag('div');

        $js = '
$(document).on(\'click\', \'[data-toggle="lightbox"]\', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({
        scale_height: false
    });
});
';
        $this->getView()->registerJs($js);

        return $html;
    }

}
