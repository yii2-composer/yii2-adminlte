<?php
/**
 * Project: fanli
 * User: liyifei
 * Date: 16/2/3
 * Time: 23:35
 */
namespace liyifei\adminlte\widgets;

use liyifei\adminlte\bundles\ColorPickerAsset;
use liyifei\adminlte\bundles\DateRangePickerAsset;
use liyifei\adminlte\bundles\DateTimePickerAsset;
use liyifei\adminlte\bundles\InputMaskAsset;
use liyifei\adminlte\bundles\SelectAsset;
use liyifei\adminlte\bundles\SwitchButtonAsset;
use liyifei\adminlte\bundles\TimePickerAsset;
use yii\base\NotSupportedException;
use yii\helpers\Json;
use yii\web\View;

class Widgets{
    public static function widgetColorPicker(View $view, $id)
    {
        $js = '$("#' . $id . '").colorpicker()';
        $view->registerJs($js);
        ColorPickerAsset::register($view);
    }

    public static function widgetSwitchButton(View $view, $id, $size)
    {
        $js = '$.fn.bootstrapSwitch.defaults.size = "' . $size . '";$.fn.bootstrapSwitch.defaults.onColor = "primary";$("#' . $id . '").bootstrapSwitch();';
        $view->registerJs($js);
        SwitchButtonAsset::register($view);
    }

    public static function widgetSelect(View $view, $id,$options=[])
    {
        $js = '$("#' . $id . '").select2('.Json::encode($options).');';
        $view->registerJs($js);
        SelectAsset::register($view);
    }

    public static function widgetInputmask(View $view, $id, $type, $format)
    {
        $options['clearMaskOnLostFocus'] = true;
        $options['removeMaskOnSubmit'] = true;
        $options[$type] = $format;
        switch ($type) {
            case 'alias':
            case 'mask':
                $js = '$("#' . $id . '").inputmask(' . json_encode($options) . ')';
                break;
            case 'regex':
                $js = '$("#' . $id . '").inputmask("Regex",' . json_encode($options) . ')';
                break;
            default:
                throw new NotSupportedException($type . ' is not supported');
        }

        $view->registerJs($js);
        InputMaskAsset::register($view);
    }

    public static function widgetTimePicker(View $view, $id)
    {
        $js = '$("#' . $id . '").timepicker({showInputs: true,showMeridian:false,showSeconds:true,minuteStep:1,secondStep:1})';
        $view->registerJs($js);
        TimePickerAsset::register($view);
    }
    
    public static function widgetYearPicker(View $view,$id,$value=''){
        $js = '$("#' . $id . '").datetimepicker({useCurrent:true,viewDate: moment("' . $value . '"),locale: "zh-cn",format:"YYYY", viewMode: "years",showTodayButton: true, showClear: true,showClose: true})';
        $view->registerJs($js);
        DateTimePickerAsset::register($view);
    }
    
    public static function widgetMonthPicker(View $view,$id,$value ='',$format='Y-m'){
        $js = '$("#' . $id . '").datetimepicker({useCurrent:true,viewDate: moment("'.$value.'"),locale: "zh-cn",format:"'.self::fixDateFormat($format).'",viewMode: "months",showTodayButton: true, showClear: true,showClose: true})';
        $view->registerJs($js);
        DateTimePickerAsset::register($view);
    }

    public static function widgetDatePicker(View $view, $id, $value = '',$format='Y-m-d')
    {
        $js = '$("#' . $id . '").datetimepicker({useCurrent:true,viewDate: moment("' . $value . '"),locale: "zh-cn",format:"' . self::fixDateFormat($format) . '",viewMode: "days",showTodayButton: true, showClear: true,showClose: true})';
        $view->registerJs($js);
        DateTimePickerAsset::register($view);
    }

    public static function widgetDateTimePicker(View $view, $id, $value = '',$format='Y-m-d H:i:s')
    {
        $js = '$("#' . $id . '").datetimepicker({useCurrent:true,viewDate: moment("' . $value . '"),locale: "zh-cn",format:"' . self::fixDateFormat($format) . '",viewMode: "days",showTodayButton: true, showClear: true,showClose: true, keepOpen: false})';
        $view->registerJs($js);
        DateTimePickerAsset::register($view);
    }
    
    public static function widgetDateTimeRangePicker(View $view,$bindid,$startid,$stopid,$startvalue,$stopvalue,$withtime=false){
        $start_default = 'moment().subtract(29, "days")';
        $stop_default = 'moment()';

        $format = ($withtime ? 'YYYY-MM-DD HH:mm:ss' : 'YYYY-MM-DD');

        $function = ',function(start,end,label){$("#' . $startid . '").val(start.format(\'' . $format . '\'));$("#' . $stopid . '").val(end.format(\'' . $format . '\'));}';
        $js = '$("#' . $bindid . '").daterangepicker({autoApply:true,locale:{format: "' . $format . '"},' . ($withtime ? 'timePicker: true,timePicker24Hour:true, timePickerIncrement: 1,timePickerSeconds:true,' : '') . 'startDate:' . ($startvalue ? "'" . $startvalue . "'" : $start_default) . ' ,endDate:' . ($stopvalue ? "'" . $stopvalue . "'" : $stop_default) . '}' . $function . ')';

        $view->registerJs($js);

        DateRangePickerAsset::register($view);
    }
    
    private static function fixDateFormat($format){
        return str_replace(['Y','m','d','H','i','s'],['YYYY','MM','DD','HH','mm','ss'],$format);
    }
}
