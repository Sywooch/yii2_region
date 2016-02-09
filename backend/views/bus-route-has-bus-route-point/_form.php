<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusRouteHasBusRoutePoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-route-has-bus-route-point-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bus_route_id')->textInput() ?>

    <?= $form->field($model, 'bus_route_point_id')->textInput() ?>

    <?= $form->field($model, 'first_point')->textInput() ?>

    <?= $form->field($model, 'end_point')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
