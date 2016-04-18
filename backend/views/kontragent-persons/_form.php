<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var common\models\KontragentPersons $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="kontragent-persons-form">

    <?php $form = ActiveForm::begin([
    'id' => 'KontragentPersons',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            
			
			<?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'oname')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'date_new')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'date_edit')->textInput(['maxlength' => true]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => $model->getAliasModel(),
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

