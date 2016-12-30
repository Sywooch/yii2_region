<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */

$this->title = Yii::t('app', 'Create Hotels Pricing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels Pricings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-pricing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
