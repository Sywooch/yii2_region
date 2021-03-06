<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */

$this->title = Yii::t('app', 'Update Hotels Pricing: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Pricings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hotels-pricing-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
