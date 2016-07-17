<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\HotelsPayPeriod $model
 */

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'HotelsPayPeriods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud hotels-pay-period-create">

    <h1>
        <?= Yii::t('app', 'HotelsPayPeriod') ?>
        <small>
            <?= $model->id ?>        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(
                Yii::t('app', 'Cancel'),
                \yii\helpers\Url::previous(),
                ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>