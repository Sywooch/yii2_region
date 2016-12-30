<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TransRoute */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Trans Route',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="trans-route-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
