<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsCharacterItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-character-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hotels_character_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\HotelsCharacter::find()->andWhere(['active'=>1])->all(),'id', 'name'),
        ['prompt' => 'Выберите характеристику']
    ) ?>

    <?= $form->field($model, 'metrics')->textInput() ?>

    <?= $form->field($model, 'hotels_info_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\HotelsInfo::findAll(['active'=>1],'id', 'name')),
        ['prompt' => 'Выберите гостиницу']
    ) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
