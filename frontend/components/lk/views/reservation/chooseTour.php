<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:30
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\BulkButtonWidget;

$this->title = Yii::t('app', 'Шаг 1. Формирование тура');
$this->params['breadcrumbs'][] = $this->title;

?>

    <h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'id', ['template' => '{input}'])->hiddenInput(['style' => 'display:none']); ?>
<?php
$date = new DateTime();
$interval = new DateInterval("P1D");
$date->add($interval);
$model->date_begin = $date->format('d.m.Y') . "\n";
$interval = new DateInterval("P6D");
$date->add($interval);
$model->date_end = $date->format('d.m.Y') . "\n";

?>
    <div class="input-group drp-container">

        <?= DateRangePicker::widget([

            'model' => $model,
            'attribute' => 'date_range',
            'useWithAddon' => true,
            'convertFormat' => true,
            'startAttribute' => 'date_begin',
            'endAttribute' => 'date_end',
            'pluginOptions' => [
                'locale' => ['format' => 'd.m.Y'],
                'label' => 'Период заезда',
            ]
        ]);
        ?>
        <span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
    </div>


<?= $form->field($model, 'tour_info_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Tour info')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'hotels_info_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Hotels info')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'hotels_appartment_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\HotelsAppartment::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Hotels appartment')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'trans_info_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\TourTypeTransport::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Tour type transport')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'userinfo_id')->widget(\kartik\widgets\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(\common\models\Userinfo::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
    'options' => ['placeholder' => Yii::t('app', 'Choose Userinfo')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'full_price')->textInput(['placeholder' => 'Full Price']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Next'), ['class' => 'btn btn-primary pull-right', 'value' => '1', 'name' => '_toperson']) ?>
    </div>
    <div class="master-tour">

    </div>
<?php ActiveForm::end(); ?>