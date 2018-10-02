<?php
/**
 * Project: weixin
 * User: liyifei
 * Date: 15/12/19
 * Time: 09:43
 */
use liyifei\adminlte\bundles\AdminLTEAsset;
use yii\helpers\Html;

if (isset($this->params[\liyifei\adminlte\AdminLTEController::PARAMS_BODY])) {
    Html::addCssClass($this->params[\liyifei\adminlte\AdminLTEController::PARAMS_BODY],$this->context->theme);
    foreach ($this->params[\liyifei\adminlte\AdminLTEController::PARAMS_BODY] as $key => $val) {
        $bodyOptions[] = $key . '="' . Html::encode($val) . '"';
    }
}
else {
    $bodyOptions = ['class'=>$this->context->theme];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
    \liyifei\adminlte\bundles\AdminLTEAsset::register($this);
    /**
     * @var $bundle AdminLTEAsset
     */
    $bundle = Yii::$app->getAssetManager()->getBundle(AdminLTEAsset::className());
    $bundle->setTheme($this->context->theme);
    $bundles = Yii::$app->getAssetManager()->bundles;
    if ($bundles) {
        foreach ($bundles as $b) {
            if (is_object($b)) {
                $b->baseUrl = $this->context->assetUrl . $b->baseUrl;
            }
        }
    }
    ?>
    
</head>
<body <?= implode(' ', $bodyOptions) ?>>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
