<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var common\models\BusRoute $model
 * @var yii\widgets\ActiveForm $form
 */
/**
 * TODO Исправить отображение input`ов точек маршрута - найти и заменить col-sm-6 на col-sm-9
 */
?>

<div class="bus-route-form">

    <?php $form = ActiveForm::begin([
            'id' => 'BusRoute',
            //'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::className(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>

            <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::className(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>

            <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::className(), [
                //'language' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </p>
        <?php $this->endBlock(); ?>


        <?php $this->beginBlock('busroutepoint'); ?>
        <div class="row">


            <?php
            $i = 0;
            foreach (\yii\helpers\ArrayHelper::toArray(
                common\models\BusRoutePoint::findAll(['active' => 1])) as $elem) {
                $i++;
                ?>
                <div class="col-md-3 panel panel-primary" id="routepoint_<?= $i ?>">
                    <h1 class="element">№<?= $i ?></h1>
                    <?= $form->field($model, "routepoint[" . $elem['id'] . "]")->checkboxList(
                        \yii\helpers\ArrayHelper::map(common\models\BusRoutePoint::findAll(['id' => $elem['id']]), 'id', 'name'),
                        ['prompt' => Yii::t('app', 'Select')]
                    ); ?>
                    <?= $form->field($model, "first_point[" . $elem['id'] . "]")->radio() ?>

                    <?= $form->field($model, "end_point[" . $elem['id'] . "]")->radio() ?>
                    <?= $form->field($model, "position[" . $elem['id'] . "]")->textInput() ?>
                    <?= $form->field($model, "date_point_forward[" . $elem['id'] . "]")->widget(\kartik\datetime\DateTimePicker::classname(), [
                        //'language' => 'ru',
                        //'dateFormat' => 'yyyy-MM-dd',
                    ]) ?>
                    <?= $form->field($model, "time_pause[" . $elem['id'] . "]")->textInput() ?>
                    <?= $form->field($model, "date_point_reverse[" . $elem['id'] . "]")->widget(\kartik\datetime\DateTimePicker::classname(), [
                        //'language' => 'ru',
                        //'dateFormat' => 'yyyy-MM-dd',
                    ]) ?>

                </div>
                <?php
            }
            ?>
        </div>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [[
                    'label' => Yii::t('app', \yii\helpers\StringHelper::basename(common\models\BusRoute::className())),
                    'content' => $this->blocks['main'],
                    'active' => true,
                ],
                    [
                        'label' => Yii::t('app', \yii\helpers\StringHelper::basename(common\models\BusRoutePoint::className())),
                        'content' => $this->blocks['busroutepoint'],
                        'active' => false,
                    ],
                ]
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

