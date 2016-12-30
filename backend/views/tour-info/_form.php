<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TourInfo */
/* @var $form yii\widgets\ActiveForm */

$model->active = 1;
$model->date_begin = date('Y-m-d H:i');
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TourInfoHasTourType',
        'relID' => 'tour-info-has-tour-type',
        'value' => \yii\helpers\Json::encode($model->tourInfoHasTourTypes),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TourInfoHasTourTypeTransport',
        'relID' => 'tour-info-has-tour-type-transport',
        'value' => \yii\helpers\Json::encode($model->tourInfoHasTourTypeTransports),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'TourPrice',
        'relID' => 'tour-price',
        'value' => \yii\helpers\Json::encode($model->tourPrices),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

\mootensai\components\JsBlock::widget(['viewFile' => '_ajaxLoadField', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'tourinfo',
        'parentID' => 'country_id',
        'relID' => 'get-city',
        'value' => \yii\helpers\Json::encode($model->city),
    ]
]);
//\mootensai\components\JsBlock::widget(['viewFile' => ''])
?>

<div class="tour-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date Begin'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('app', 'Choose Date End'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'days')->textInput(['placeholder' => 'Days']) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'hotels_info_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => Yii::t('app', 'Choose Hotels info')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php
    if ($model->getCountry()) {
        $countryId = $model->getCountry()->id;
    } else {
        $countryId = 0;
    }
    ?>
    <?=
    $form->field($model, 'country_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\Country::find()->all(), 'id', 'name'),
        [
            'prompt' => Yii::t('app', 'Select'),
            'options' => [$countryId => ['selected' => true]]
        ]
    ); ?>


    <?php
    \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'tourinfo-city']);
    ?>

    <div id="tourinfo-get-city">
        <?php
        if ($model->isNewRecord) {
            echo $form->field($model, 'city_id')->dropDownList(
                [],
                ['prompt' => Yii::t('app', 'Begin Select Country'),
                    'disabled' => '']
            );
        } else {
            echo $form->field($model, 'city_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\City::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'Choose City')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        }
        ?>
    </div>
    <?php
    \yii\widgets\Pjax::end();
    ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TourInfoHasTourType')),
            'content' => $this->render('_formTourInfoHasTourType', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->tourInfoHasTourTypes),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TourInfoHasTourTypeTransport')),
            'content' => $this->render('_formTourInfoHasTourTypeTransport', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->tourInfoHasTourTypeTransports),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TourPrice')),
            'content' => $this->render('_formTourPrice', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->tourPrices),
            ]),
        ],
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
