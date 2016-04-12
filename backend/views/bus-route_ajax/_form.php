<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-route-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
                'value' => function() {
                    return new \yii\db\Expression('NOW()');
                },
            ]) ?>

    <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>

    <div class="tabs">
        <?= $form->field($model, 'busRoutePoints')->checkboxList(\common\models\BusRoutePoint::listAll(),['multiple' => true]);/* checkboxList($busroute_model->getBusRoutePoints)*/; ?>
        <?php
        /*$ur_names = ArrayHelper::map(UserRole::find()->all(),'id','role_name');
        echo $form->field($model, 'user_role_id')->dropDownList(
            $ur_names,
            ['prompt' => 'Выберите пользователя'] // текст, который отображается в качестве первого варианта
        )->label('Роли пользователей');*/
        ?>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
