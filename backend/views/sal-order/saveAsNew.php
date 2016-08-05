<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Sal Order',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sal Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="sal-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>