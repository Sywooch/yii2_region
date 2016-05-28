<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsCharacter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-character-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\HotelsCharacter::find()->andFilterWhere(['active'=>1])
            ->andFilterWhere(['!=','parent_id',$model->id]) ->asArray()->all(), 'id', 'name'),
        ['prompt'=>'Выберите родительскую характеристику']
    ) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
