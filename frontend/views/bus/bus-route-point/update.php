<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\bus\BusRoutePoint */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Bus Route Point',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Route Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bus-route-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
