<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartment */

$this->title = Yii::t('app', 'Save As New {modelClass}: ', [
        'modelClass' => 'Hotels Appartment',
    ]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Appartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Save As New');
?>
<div class="hotels-appartment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
