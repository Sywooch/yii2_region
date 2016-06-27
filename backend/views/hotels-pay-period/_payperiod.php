<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin([
    'action' => Url::toRoute(['hotels-pay-period/update', 'hotels_pricing_id' => $model->id]),
    'options' => [
        'data-pjax' => '1'
    ],
    'id' => 'hotels-pay-period_UpdateForm'
]); ?>

<?php foreach ($model->payperiod as $key => $payperiod): ?>
    <?= $form->field($payperiod, "[$key]date_begin") ?>
    <?= $form->field($payperiod, "[$key]date_end") ?>
    <?= $form->field($payperiod, "[$key]price") ?>
    <?= $form->field($payperiod, "[$key]active") ?>


    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
<?php endforeach ?>

<?= Html::a('Добавить период', Url::toRoute(['hotels-pay-period/create', 'userId' => $model->id]), [
    'class' => 'btn btn-success',
]) ?>

<?= Html::a('Удалить', Url::toRoute(['hotels-pay-period/delete', 'id' => $address->id]), [
    'class' => 'btn btn-danger',
]) ?>
<?php ActiveForm::end(); ?>