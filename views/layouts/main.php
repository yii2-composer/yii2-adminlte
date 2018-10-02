<?php
/**
 * Project: weixin
 * User: chenzhidong
 * Date: 15/12/19
 * Time: 09:43
 */
use liyifei\adminlte\AdminLTEController;
use liyifei\adminlte\bundles\AdminLTEAsset;
use liyifei\adminlte\widgets\Breadcrumbs;
use liyifei\adminlte\widgets\Nav;
use liyifei\adminlte\widgets\NavBar;
use liyifei\adminlte\widgets\SideBar;
use yii\helpers\Html;

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
    \liyifei\adminlte\bundles\SlimScrollAsset::register($this);
    \liyifei\adminlte\bundles\FastClickAsset::register($this);
    \liyifei\adminlte\bundles\AdminLTEAsset::register($this);
    /**
     * @var $bundle AdminLTEAsset
     */
    $bundle = Yii::$app->getAssetManager()->getBundle(AdminLTEAsset::className());
    $bundle->setTheme($this->context->theme);
    $bundles = Yii::$app->getAssetManager()->bundles;
    if($bundles){
        foreach($bundles as $b){
            if(is_object($b)){
                $b->baseUrl = $this->context->assetUrl.$b->baseUrl;
            }
        }
    }
    ?>
</head>
<body class="hold-transition <?= $this->context->theme ?> sidebar-mini fixed">
<?php $this->beginBody() ?>
<div class="wrapper">
    <header class="main-header">
        <a href="<?= Yii::$app->homeUrl ?>" class="logo">
            <span class="logo-mini"><?php echo isset(Yii::$app->params['brand_mini'])?Yii::$app->params['brand_mini']:Yii::$app->id ?></span>
            <span class="logo-lg"><?php echo isset(Yii::$app->params['brand_large'])?Yii::$app->params['brand_large']:Yii::$app->id ?></span>
        </a>
        <?php
        NavBar::begin();
        if (isset($this->params[AdminLTEController::PARAMS_NAVBAR]) && is_array($this->params[AdminLTEController::PARAMS_NAVBAR])) {
            echo Nav::widget([
                                 'items' => $this->params[AdminLTEController::PARAMS_NAVBAR],
                             ]);
        }
        NavBar::end();
        ?>
    </header>
    <?php if(isset($this->params[AdminLTEController::PARAMS_SIDEBAR]) && is_array($this->params[AdminLTEController::PARAMS_SIDEBAR])): ?>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?php
            echo SideBar::widget([
                                     'items' => $this->params[AdminLTEController::PARAMS_SIDEBAR],
                                     'actives'=>isset($this->params[AdminLTEController::PARAMS_SIDEBAR_ACTIVES])? $this->params[AdminLTEController::PARAMS_SIDEBAR_ACTIVES]:[]
                                 ])
            ?>
        </section>
    </aside>
    <div class="content-wrapper">
        <?php else: ?>
        <div class="wrapper">
            <?php endif; ?>
            <section class="content-header">
                <h1><?= Html::encode($this->title) ?></h1>
                <?= Breadcrumbs::widget([
                                            'links' => isset($this->params[AdminLTEController::PARAMS_BREADCRUMBS]) ? $this->params[AdminLTEController::PARAMS_BREADCRUMBS] : [],
                                        ]) ?>
            </section>
            <section class="content">
                <?= $content ?>
            </section>

        </div>
        <?php if (isset(Yii::$app->params['copyright'])): ?>
            <footer class="main-footer">
                <strong><?= Yii::$app->params['copyright'] ?></strong>
            </footer>
        <?php endif; ?>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

