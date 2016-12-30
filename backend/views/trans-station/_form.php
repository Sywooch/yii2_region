<?php
use common\models\TransTypeStation as typeStation;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TransStation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?php
    $ur_names = ArrayHelper::map(typeStation::find()->all(),'id','name');

    echo $form->field($model, 'trans_type_station_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите тип вокзала'] // текст, который отображается в качестве первого варианта
    )->label('Тип вокзала');
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php /*echo $form->field($model, 'gps_parallel')->textInput()*/ ?>

    <?php /*echo $form->field($model, 'gps_meridian')->textInput()*/ ?>
    <?= $form->field($model, 'city_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(common\models\City::find()->active()->orderBy('name')->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select')])
    ?>

    <?= $form->field($model, 'address_id')->textInput() ?>




  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
