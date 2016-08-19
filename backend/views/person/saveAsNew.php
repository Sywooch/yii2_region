<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Person */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Person',
    ]) . ' ' . $model->firstname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->firstname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
