<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use kartik\widgets\FileInput;

/**
 * @var yii\web\View $this
 * @var common\models\HotelsAppartment $model
 * @var yii\widgets\ActiveForm $form
 */
$items = $model->getImage2amigos();

$this->registerJs('
$("#hotelsappartment-country").on("change", function() {
$.pjax.reload("#hotelsappartement-gethotelsinfo div div.col-sm-6", {
history: false,
data: $(this).serialize(),
type: \'POST\',
url: \'gethotelsinfo\',

});
});

');
?>




<div class="hotels-appartment-form">

    <?php $form = ActiveForm::begin([
            'id' => 'HotelsAppartment',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?= $form->field($model, 'country')->dropDownList(
                \yii\helpers\ArrayHelper::map(common\models\Country::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', 'Select'),]
            ); ?>


            <?php
            \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'hotelsappartment-hotelsinfo']);
            ?>

            <div id="hotelsappartement-gethotelsinfo">
            <?= // generated by schmunk42\giiant\generators\crud\providers\RelationProvider::activeField
            $form->field($model, 'hotels_info_id')->dropDownList(
                /*\yii\helpers\ArrayHelper::map(common\models\HotelsInfo::find()->all(), 'id', 'name'),*/
                [],
                ['prompt' => Yii::t('app', 'Begin Select Country'),
                'disabled' => '']
            ); ?>
        </div>
            <?php
            \yii\widgets\Pjax::end();
            ?>

            <?= // generated by schmunk42\giiant\generators\crud\providers\RelationProvider::activeField
            $form->field($model, 'hotels_appartment_item_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(common\models\HotelsAppartmentItem::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', 'Select')]
            ); ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'imageFiles[]')->widget(FileInput::className(),[
            'language' => 'ru',
            'options' => ['multiple' => true, 'accept' => 'image/*',],
            'pluginOptions' => [
                'showRemove' => 'true',
                'previewFileType' => 'any',
                'allowedExtensions' => ['jpg','gif','png'],
                'showUpload' => false,
                'maxFileCount' => 12,
                //'uploadUrl' => \yii\helpers\Url::to(['uploads'])
            ],

        ]); ?>





        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [[
                    'label' => Yii::t('app', \yii\helpers\StringHelper::basename(common\models\HotelsAppartment::className())),
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

