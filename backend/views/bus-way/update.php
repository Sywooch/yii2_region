<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Bus Way',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Ways'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="bus-way-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
