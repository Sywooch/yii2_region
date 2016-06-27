<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\HotelsPricing $model
*/

$this->title = Yii::t('app', 'HotelsPricing') . $model->name . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'HotelsPricings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud hotels-pricing-update">

    <h1>
        <?= Yii::t('app', 'HotelsPricing') ?>
        <small>
                        <?= $model->name ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
