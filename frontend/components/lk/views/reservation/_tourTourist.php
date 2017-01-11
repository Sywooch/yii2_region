<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 11.01.17
 * Time: 5:43
 */


?>
<div class="tourist-info">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Кто едет?</h3>
        </div>
        <div class="panel-body">
            <?=
            $form->field($model, 'touristCount')->widget(\kartik\widgets\TouchSpin::className()
            ); ?>

            <?=
            $form->field($model, 'childCount')->widget(\kartik\widgets\Select2::className(), [
                    'data' => ['0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4],
                    'options' => [
                        'prompt' => Yii::t('app', 'Select'),
                        //'id'=>'hotels-appartment-country-id',
                    ]
                ]
            ); ?>

            <?= \yii\helpers\Html::label('Возраст детей', 'tourist-child-years-label', ['id' => 'tourist-child-years-label', 'style' => 'display:none;']); ?>
            <?= $form->field($model, 'childYears[]', ['template' => '{input}'])->textInput(['id' => 'tourist-child-years-1', 'style' => 'display:none']); ?>
            <?= $form->field($model, 'childYears[]', ['template' => '{input}'])->textInput(['id' => 'tourist-child-years-2', 'style' => 'display:none']); ?>
            <?= $form->field($model, 'childYears[]', ['template' => '{input}'])->textInput(['id' => 'tourist-child-years-3', 'style' => 'display:none']); ?>
            <?= $form->field($model, 'childYears[]', ['template' => '{input}'])->textInput(['id' => 'tourist-child-years-4', 'style' => 'display:none']); ?>
        </div>
        <?php

        ?>
    </div>
</div>
