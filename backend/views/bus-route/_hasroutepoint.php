<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var common\models\BusRouteHasBusRoutePoint $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="bus-route-has-bus-route-point-form">

    <?php $form = ActiveForm::begin([
            'id' => 'BusRouteHasBusRoutePoint',
            'options' => [
                'data-pjax' => '1'
            ],
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?=
            $form->field($model, 'bus_route_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(common\models\BusRoute::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', 'Select')]
            ); ?>
            <?=
            $form->field($model, 'bus_route_point_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(common\models\BusRoutePoint::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', 'Select')]
            ); ?>
            <?= $form->field($model, 'first_point')->checkbox() ?>
            <?= $form->field($model, 'end_point')->checkbox() ?>
            <?= $form->field($model, 'position')->textInput() ?>
            <?= $form->field($model, 'date_point_forward')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
            <?= $form->field($model, 'time_pause')->textInput() ?>
            <?= $form->field($model, 'date_point_reverse')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
            <?= $form->field($model, 'date_add')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
            <?= $form->field($model, 'date_edit')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [ [
                    'label'   => Yii::t('app', \yii\helpers\StringHelper::basename(common\models\BusRouteHasBusRoutePoint::className())),
                    'content' => $this->blocks['main'],
                    'active'  => true,
                ], ]
            ]
        );
        ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
            '<span class="glyphicon glyphicon-check"></span> ' .
            ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
            [
                'id' => 'save-' . $model->formName(),
                'class' => 'btn btn-success'
            ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
