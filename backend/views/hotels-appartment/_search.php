<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var backend\models\SearchHotelsAppartemnt $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="hotels-appartment-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'hotels_info_id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'price') ?>

		<?php // echo $form->field($model, 'hotels_appartment_item_id') ?>

		<?php // echo $form->field($model, 'date_add') ?>

		<?php // echo $form->field($model, 'date_edit') ?>

    <?php echo $form->field($model, 'active') ?>

    <?php echo $form->field($model, 'count_rooms') ?>

    <?php echo $form->field($model, 'count_beds') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
