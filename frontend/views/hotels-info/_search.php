<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var frontend\models\SearchHotelsInfo $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="hotels-info-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'address') ?>

		<?= $form->field($model, 'country') ?>

		<?= $form->field($model, 'GPS') ?>

		<?php // echo $form->field($model, 'links_maps') ?>

		<?php // echo $form->field($model, 'hotels_stars_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
