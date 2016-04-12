<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\BusRouteHasBusRoutePoint $model
*/

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => 'Bus Route Has Bus Route Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud bus-route-has-bus-route-point-create">

    <h1>
        <?= Yii::t('app', 'Bus Route Has Bus Route Point') ?>        <small>
                        <?= $model->bus_route_id ?>        </small>
    </h1>

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?=             Html::a(
            Yii::t('app', 'Cancel'),
            \yii\helpers\Url::previous(),
            ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
