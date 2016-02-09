<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\BusInfo;
use common\models\BusRoute;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-way-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?php
        $ur_names = ArrayHelper::map(BusInfo::find()->all(),'id','name');

        echo $form->field($model, 'bus_info_id')->dropDownList(
            $ur_names,
            ['prompt' => 'Выберите автобус'] // текст, который отображается в качестве первого варианта
        )->label('Автобусы');
    ?>

    <?= $form->field($model, 'date_create')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'ended')->checkbox() ?>

    <?php
        $ur_names = ArrayHelper::map(BusRoute::find()->all(),'id','name');

        echo $form->field($model, 'bus_path_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите маршрут'] // текст, который отображается в качестве первого варианта
        )->label('Маршрут');
    ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
