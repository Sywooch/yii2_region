<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\HotelsStars;
use kartik\widgets\FileInput;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'address')->textInput() ?>

    <?php
    $rel_names = ArrayHelper::map(Country::find()->all(),'id','name');

    echo $form->field($model, 'country')->dropDownList(
        $rel_names,
        ['prompt' => 'Выберите Страну'] // текст, который отображается в качестве первого варианта
    )->label('Страна');
    ?>

    <?= $form->field($model, 'GPS')->textInput() ?>

    <?= $form->field($model, 'links_maps')->textInput() ?>

    <?php
    $rel_names = ArrayHelper::map(HotelsStars::find()->all(),'id','name');

    echo $form->field($model, 'hotels_stars_id')->dropDownList(
        $rel_names,
        ['prompt' => 'Выберите количество звёзд гостиницы'] // текст, который отображается в качестве первого варианта
    )->label('Количество звёзд данной гостиницы');
    ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
    'options' => [
        'accept' => 'image/*',
        'previewFileType' => 'any'
    ],
    ])?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
