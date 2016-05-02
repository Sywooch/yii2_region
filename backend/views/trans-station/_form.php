<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TransTypeStation as typeStation;

/* @var $this yii\web\View */
/* @var $model common\models\TransStation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gps_parallel')->textInput() ?>

    <?= $form->field($model, 'gps_meridian')->textInput() ?>

    <?= $form->field($model, 'address_id')->textInput() ?>

    <?php
    $ur_names = ArrayHelper::map(typeStation::find()->all(),'id','name');

    echo $form->field($model, 'trans_type_station_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите тип вокзала'] // текст, который отображается в качестве первого варианта
    )->label('Тип вокзала');
    ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
