<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var common\models\TourInfo $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs('
$("#tourinfo-country").on("change", function() {
$.pjax.reload("#tourinfo-gethotelsinfo div div.col-sm-6", {
history: false,
data: $(this).serialize(),
type: \'POST\',
url: \'gethotelsinfo\',

});
});
');

if (!$model->isNewRecord) {

    $this->registerJs('
        $("#hotelsappartment-hotels_info_id").on("change", function() {
        $.pjax.reload("#tourinfo-gethotelsappartment div div.col-sm-6", {
        history: false,
        data: $(this).serialize(),
        type: \'POST\',
        url: \'getappartment\',
        
        });
        });'
    );
}
?>

<div class="tour-info-form">

    <?php $form = ActiveForm::begin([
            'id' => 'TourInfo',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>

            <?=
            /*Chosen::widget([
                'model' => $model,
                'attribute' => 'tag_list',
                'items' => ArrayHelper::map(
                    Tag::find()->select('id, title')->orderBy('title')->asArray()->all(),
                    'id',
                    'title'
                ),
                'multiple' => true,
            ]);*/
            $form->field($model, 'tourtype_list')->checkboxList(
                \yii\helpers\ArrayHelper::map(common\models\TourType::find()->orderBy('name')->all(), 'id', 'name'),
                [
                    'prompt' => Yii::t('app', 'Select'),
                    //'options' => [$countryId => ['selected' => true]]
                ]
            ); ?>

            <?= $form->field($model, 'active')->checkbox() ?>

            <?= $form->field($model, 'name')->textInput(['rows' => 6]) ?>
            <?= $form->field($model, 'date_begin')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>
            <?= $form->field($model, 'date_end')->widget(\kartik\datetime\DateTimePicker::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>
            <?= $form->field($model, 'days')->widget(\kartik\widgets\TouchSpin::classname(), [
                //'langauge' => 'ru',
                //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            ]) ?>


        </p>
        <?php $this->endBlock(); ?>


        <?php $this->beginBlock('hotels'); ?>

        <p>
            <?php
            if ($model->getCountry()) {
                $countryId = $model->getCountry()->id;
            } else {
                $countryId = 0;
            }
            ?>
            <?=
            $form->field($model, 'country')->dropDownList(
                \yii\helpers\ArrayHelper::map(common\models\Country::find()->all(), 'id', 'name'),
                [
                    'prompt' => Yii::t('app', 'Select'),
                    'options' => [$countryId => ['selected' => true]]
                ]
            ); ?>


            <?php
            \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-tourinfo-hotelsinfo']);
            ?>

        <div id="tourinfo-gethotelsinfo">
            <?php

            if ($model->isNewRecord) {
                echo $form->field($model, 'hotels_info_id')->dropDownList(
                    [],
                    ['prompt' => Yii::t('app', 'Begin Select Country'),
                        'disabled' => '']
                );
            } else {
                echo $form->field($model, 'hotels_info_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(common\models\HotelsInfo::find()
                        ->andFilterWhere([
                            'active' => 1,
                            'country' => $model->country,
                        ])->orderBy('name')->all(), 'id', 'name'),
                    ['prompt' => Yii::t('app', 'Begin Select Country')]
                );
            }
            ?>
        </div>
        <?php
        \yii\widgets\Pjax::end();
        ?>

        </p>
        <?php
        \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-tourinfo-gethotelsappartment']);
        ?>
        <hr />
        <p>
            Информация о гостинице <?php /*
            \yii\helpers\ArrayHelper::getValue(common\models\HotelsInfo::find()
                ->andFilterWhere([
                    'active' => 1,
                    'id' => $model->hotels_info_id,
                ])
            );*/
            ?>.
        <?php
        \yii\widgets\Pjax::end();
        ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('transport'); ?>

        <p>
            <?=
            $form->field($model, 'tourtypetransport_list')->checkboxList(
                \yii\helpers\ArrayHelper::map(common\models\TourTypeTransport::find()->orderBy('name')->all(), 'id', 'name'),
                [
                    'prompt' => Yii::t('app', 'Select'),
                    //'options' => [$countryId => ['selected' => true]]
                ]
            ); ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [[
                    'label' => Yii::t('app', StringHelper::basename('common\models\TourInfo')),
                    'content' => $this->blocks['main'],
                    'active' => true,
                ],
                    [
                        'label' => Yii::t('app', StringHelper::basename('common\models\HotelsInfo')),
                        'content' => $this->blocks['hotels'],

                    ],
                    [
                        'label' => Yii::t('app', StringHelper::basename('common\models\TourTypeTransport')),
                        'content' => $this->blocks['transport'],

                    ],
                ]
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

<script type="text/javascript">

    $("#tourinfo-hotels_info_id").on("change", function() {
        var now = new Date();
        now = now.getFullYear();
        var value = $("#tourinfo-hotels_info_id option:selected").text();
        value = "Тур за " + now + " год для гостиницы \"" + value + "\".";
        $("#tourinfo-name").val(value);
    });
</script>