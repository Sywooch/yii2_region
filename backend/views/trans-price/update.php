<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransPrice */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Trans Price',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="trans-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
