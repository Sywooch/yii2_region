<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KursTypeCurrency */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kurs Type Currency',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kurs Type Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kurs-type-currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
