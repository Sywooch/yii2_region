<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'BusRouteHasBusRoutePoint',
        'relID' => 'bus-route-has-bus-route-point', 
        'value' => \yii\helpers\Json::encode($model->busRouteHasBusRoutePoints),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
/*\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'BrToBrpTime',
        'relID' => 'br-to-brp-time',
        'value' => \yii\helpers\Json::encode($model->brToBrpTimes),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);*/
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'BusWay',
        'relID' => 'bus-way', 
        'value' => \yii\helpers\Json::encode($model->busWays),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

if ($model->isNewRecord){
    $model->date_begin = date('Y-m-d');
}

?>

<div class="bus-route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <label class="control-label">Период действия</label>
    <div class="input-group drp-container" style="margin-bottom: 10px;">

    <?php

    $addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
    echo \kartik\daterange\DateRangePicker::widget([
            'model' => $model,
            'attribute' => 'rangedate1',
            'startAttribute' => 'date_begin',
            'endAttribute' => 'date_end',
        //'name'=>'rangedate1',
        'convertFormat'=>true,
        'useWithAddon'=>true,
        //'language'=>'Russian',             // from demo config
        'hideInput'=>false,           // from demo config
        'presetDropdown'=>false, // from demo config
        'pluginOptions'=>[
            'locale'=>['format'=>'Y-m-d'], // from demo config
            'separator'=>' - ',//from demo config
            'opens'=>'left'
        ]
    ]).$addon;
    ?>
    </div>

    <?= $form->field($model, 'b_reverse')->checkbox() ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        /*[
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Тестовые маршрутные точки')),
            'content' => $this->render('_formBrToBrpTime', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->brToBrpTimes),
            ]),
        ],*/
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'BusRouteHasBusRoutePoint')),
            'content' => $this->render('_formBusRouteHasBusRoutePoint', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->busRouteHasBusRoutePoints),
            ]),
        ],
        /*[
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'BusWay')),
            'content' => $this->render('_formBusWay', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->busWays),
            ]),
        ],*/

    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if (Yii::$app->controller->action->id != 'create'): ?>
            <?= Html::submitButton(Yii::t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
