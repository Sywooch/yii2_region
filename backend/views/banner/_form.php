<?php

use dmstr\bootstrap\Tabs;
use kartik\widgets\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var common\models\Banner $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="banner-form">

    <?php $form = ActiveForm::begin([
            'id' => 'Banner',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error',
            'options' => ['enctype' => 'multipart/form-data'],
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'link')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'active')->checkbox() ?>
            <?= $form->field($model, 'count')->textInput() ?>
            <?= $form->field($model, 'imageFiles')->widget(FileInput::className(), [
                'language' => 'ru',
                'options' => ['multiple' => false, 'accept' => 'image/*',],
                'pluginOptions' => [
                    'showRemove' => 'true',
                    'previewFileType' => 'any',
                    'allowedExtensions' => ['jpg', 'gif', 'png'],
                    'showUpload' => false,
                    'maxFileCount' => 1,
                    //'uploadUrl' => \yii\helpers\Url::to(['uploads'])
                ],

            ]); ?>
            <?= $model->file ?
                $model->getThumb() :
                "" ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [[
                    'label' => Yii::t('app', StringHelper::basename('common\models\Banner')),
                    'content' => $this->blocks['main'],
                    'active' => true,
                ],]
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

