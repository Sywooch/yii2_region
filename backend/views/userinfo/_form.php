<?php
use common\models\UserRole;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use kartik\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Userinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="userinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php
    if ($model->isNewRecord){
        echo $form->field($model, 'password')->textInput();
    }
?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?php
    $ur_names = ArrayHelper::map(UserRole::find()->all(),'id','role_name');
        echo $form->field($model, 'user_role_id')->dropDownList(
            $ur_names,
            ['prompt' => 'Выберите роль'] // текст, который отображается в качестве первого варианта
        )->label('Роли пользователей');
    ?>

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
