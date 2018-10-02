<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/5
 * Time: 21:26
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\MorrisAsset;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\bootstrap\Html;

class Morris extends Widget
{
    const TYPE_AREA = "area";
    const TYPE_LINE = "line";
    const TYPE_DONUT = "donut";
    const TYPE_BAR = "bar";

    public $type = "";
    public $height = 300;
    /**
     * @var array
     *
     * type: TYPE_AREA|TYPE_LINE|TYPE_BAR
     *  [
     *      ["y"=>"xxxx","a"=>"100","b"=>"90"],
     *      ["y"=>"yyyy","a"=>"75","b"=>"60"],
     *  ]
     *
     * type: TYPE_DONUT
     *  [
     *      ["label"=>"aaaa","value"=>"12"],
     *      ["label"=>"bbbb","value"=>"24"],
     *  ]
     */
    public $data;
    public $xkey;
    public $ykeys;
    public $labels;
    public $colors;

    public function run()
    {
        MorrisAsset::register($this->getView());
        switch ($this->type) {
            case self::TYPE_AREA:
            case self::TYPE_LINE:
                $js = $this->arealine($this->type, $this->getId(), $this->data, $this->xkey,
                    $this->ykeys, $this->labels, $this->colors);
                break;
            case self::TYPE_DONUT:
                $js = $this->donut($this->getId(), $this->data, $this->colors);
                break;
            case self::TYPE_BAR:
                $js = $this->bar($this->getId(), $this->data, $this->xkey, $this->ykeys,
                    $this->labels, $this->colors);
                break;
            default:
                throw new InvalidConfigException($this->type . 'is not supported');
                break;
        }
        $this->getView()->registerJs($js);

        return Html::tag('div', "", [
            'class' => 'chart',
            'id' => $this->getId(),
            'style' => 'height: ' . $this->height . 'px;',
        ]);
    }

    private function arealine($type, $id, $data, $xkey, $ykeys, $labels, $colors)
    {
        return 'new Morris.' . ucfirst($type) . '({
            element: "' . $id . '",
            resize: true,
            data: ' . json_encode($data) . ',
            xkey: "' . $xkey . '",
            ykeys: ' . json_encode(array_values($ykeys)) . ',
            labels: ' . json_encode(array_values($labels)) . ',
            lineColors:' . json_encode(array_values($colors)) . ',
            hideHover: "auto",
            parseTime: false,
        });';
    }

    private function donut($id, $data, $colors)
    {
        return 'new Morris.Donut({
            element: "' . $id . '",
            resize: true,
            data: ' . json_encode($data) . ',
            colors:' . json_encode(array_values($colors)) . ',
            hideHover: "auto",
            parseTime: false,
        });';
    }

    private function bar($id, $data, $xkey, $ykeys, $labels, $colors)
    {
        return 'new Morris.Bar({
            element: "' . $id . '",
            resize: true,
            data: ' . json_encode($data) . ',
            xkey: "' . $xkey . '",
            ykeys: ' . json_encode(array_values($ykeys)) . ',
            labels: ' . json_encode(array_values($labels)) . ',
            barColors:' . json_encode(array_values($colors)) . ',
            hideHover: "auto",
            parseTime: false,
        });';
    }
}
