<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\HotelsStars;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address_id')->textInput() ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'GPS')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'links_maps')->textarea(['rows' => 6]) ?>

    <?php
    $ur_names = ArrayHelper::map(HotelsStars::find()->all(),'id','name');

    echo $form->field($model, 'hotels_stars_id')->dropDownList(
        $ur_names,
        ['prompt' => 'Выберите количество звёзд гостиницы'] // текст, который отображается в качестве первого варианта
    )->label('Количество звёзд данной гостиницы');
    ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
