<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TransInfo */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Trans Info',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="trans-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
