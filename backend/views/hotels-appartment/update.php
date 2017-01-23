<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartment */

$this->title = Yii::t('app', 'Update Hotels Appartment: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Appartments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'hotels_info_id' => $model->hotels_info_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hotels-appartment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
