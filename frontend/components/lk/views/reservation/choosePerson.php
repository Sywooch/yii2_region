<?php

//Шаг 2 мастера создания тура для турагенств - ввод персональных данных туристов


use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\bus\Person */
/* @var $form yii\widgets\ActiveForm */
/*
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'BusReservationHasPerson',
        'relID' => 'bus-reservation-has-person',
        'value' => \yii\helpers\Json::encode($model->busReservationHasPeople),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'SalOrderHasPerson',
        'relID' => 'sal-order-has-person',
        'value' => \yii\helpers\Json::encode($model->salOrderHasPeople),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);*/
echo \yii\base\View::render('../layouts/menu.php');
$this->title = Yii::t('app', 'Step 2. Choose person');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="person-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //Выводим списком уже зарегистрированных туриство
    if (isset($oldPerson)) {
        if (is_array($oldPerson) && count($oldPerson) > 0) {
            ?>
            <div class="record_persons">

                <?php
                $li = array();
                foreach ($oldPerson as $key => $value) {
                    $tr = $value->getPerson();
                    $d = $tr->all();
                    $li [] = $d[0]->lastname . ' ' .
                        $d[0]->firstname . ' ' .
                        $d[0]->secondname;

                }
                echo Html::ol($li, [

                ]);
                ?>
            </div>
            <?php
        }
    }
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'lastname')->textInput(['placeholder' => Yii::t('app', 'Lastname')]) ?>

    <?= $form->field($model, 'firstname')->textInput(['placeholder' => Yii::t('app', 'Firstname')]) ?>

    <?= $form->field($model, 'secondname')->textInput(['placeholder' => Yii::t('app', 'Secondname')]) ?>

    <?= $form->field($model, 'passport_ser')->textInput(['placeholder' => 'Passport Ser']) ?>

    <?= $form->field($model, 'passport_num')->textInput(['placeholder' => 'Passport Num']) ?>

    <?= $form->field($model, 'contacts')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'child')->checkbox() ?>

    <?php
    /*$forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'BusReservationHasPerson')),
            'content' => $this->render('_formBusReservationHasPerson', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->busReservationHasPeople),
            ]),
        ],
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'SalOrderHasPerson')),
            'content' => $this->render('_formSalOrderHasPerson', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->salOrderHasPeople),
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
    ]);*/
    ?>
    <div class="form-group">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Add person'), ['class' => 'btn btn-primary pull-left', 'value' => '1', 'name' => '_personadd']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Next'), ['class' => 'btn btn-primary pull-right', 'value' => '1', 'name' => '_toreserv']) ?>
        </div>
        <div class="master-tour">
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
