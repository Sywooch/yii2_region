<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var common\models\HotelsPricing $model
 * @var yii\widgets\ActiveForm $form
 */

$this->registerJs('
$("#hotelspricing-country").on("change", function() {
$.pjax.reload("#hotelsappartement-gethotelsinfo div div.col-sm-6", {
history: false,
data: $(this).serialize(),
type: \'POST\',
url: \'gethotelsinfo\',

});
});
');

if (!$model->isNewRecord) {
    $this->registerJs('
        $("#hotelspricing-hotels_appartment_hotels_info_id").on("change", function() {
        $.pjax.reload("#pjax-hotelspricing-hotelsinfo div div.col-sm-6", {
        history: false,
        data: $(this).serialize(),
        type: \'POST\',
        url: \'getappartment\',
        
        });
        });'
    );

    $this->registerJs('
    $(function(){
    $(document).on(\'click\', \'[data-toggle=reroute]\', function(e) {
        e.preventDefault();
        var action = $(this).attr(\'href\');
        $.pjax.reload(\'#pjax-hotels-pay-period\', {
                history: false,
                data: $(\'#hotels-pay-period_UpdatePjax input, select\').serialize(),
                type: \'POST\',
                url: action,
                success: function(data){
                    $(\'.result\').html(data);
                },
                error: function(xhr, str){
                    alert(\'Возникла ошибка: \' + xhr.responseCode);
                  }
            });
    });
});
    ');

    $this->registerJs("
    
        function pay_update(){
            $.pjax.reload('#pjax-hotels-pay-period', {
                history: false,
                data: $('#hotels-pay-period_UpdatePjax input, select').serialize(),
                type: 'POST',
                url: '". \yii\helpers\Url::toRoute(['hotels-pay-period/update', 'hotels_pricing_id' => $model->id]) ."',
                success: function(data){
                    $('.result').html(data);
                },
                error: function(xhr, str){
                    alert('Возникла ошибка: ' + xhr.responseCode);
                  }
            });
        };
    ", yii\web\View::POS_END);
}

?>
<?php
\yii\widgets\Pjax::begin()
?>
<div class="hotels-pricing-form">

    <?php $form = ActiveForm::begin([
            'id' => 'HotelsPricing',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

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
            \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'hotelsappartment-hotelsinfo']);
            ?>

        <div id="hotelsappartement-gethotelsinfo">
            <?php

            if ($model->isNewRecord) {
                echo $form->field($model, 'hotels_appartment_hotels_info_id')->dropDownList(
                    [],
                    ['prompt' => Yii::t('app', 'Begin Select Country'),
                        'disabled' => '']
                );
            } else {
                echo $form->field($model, 'hotels_appartment_hotels_info_id')->dropDownList(
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

        <?php
        \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-hotelspricing-hotelsinfo']);
        ?>
        <?php
        $params = array();
        if ($model->isNewRecord) {
            $params = ['prompt' => Yii::t('app', 'Begin Select Hotels'),
                'disabled' => ''];
        } else {
            $params = ['prompt' => Yii::t('app', 'Select Hotels')];
        }
        echo $form->field($model, 'hotels_appartment_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(common\models\HotelsAppartment::find()
                ->andFilterWhere([
                    'hotels_info_id' => $model->hotels_appartment_hotels_info_id,
                ])->orderBy('name')->all(), 'id', 'name'),
            $params
        ); ?>
        <?php
        \yii\widgets\Pjax::end();
        ?>

        <?= // generated by schmunk42\giiant\generators\crud\providers\RelationProvider::activeField
        $form->field($model, 'hotels_type_of_food_id')->dropDownList(
            \yii\helpers\ArrayHelper::map(common\models\HotelsTypeOfFood::find()->all(), 'id', 'name'),
            ['prompt' => Yii::t('app', 'Select')]
        ); ?>
        <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
            //'langauge' => 'ru',
            //'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
        ]) ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'active')->checkbox() ?>
        </p>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('payperiod'); ?>
        <?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'id' => 'pjax-hotels-pay-period']); ?>
        <?php
        if ($model->isNewRecord) {
            ?>
            <p>&nbsp;</p>
            <p class="text-success">
                Перед заполнением сохраните все данные.
            </p>
            <?php
        } else {
            echo $this->renderAjax('_payperiod', ['model' => $model]);
        }
        ?>
        <?php \yii\widgets\Pjax::end(); ?>
        <?php $this->endBlock(); ?>

        <?=
        Tabs::widget(
            [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('app', StringHelper::basename('common\models\HotelsPricing')),
                        'content' => $this->blocks['main'],
                        'active' => true,
                    ],
                    [
                        'label' => Yii::t('app', StringHelper::basename('common\models\HotelsPayPeriod')),
                        'content' => $this->blocks['payperiod'],
                    ]
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

<?php
\yii\widgets\Pjax::end();
?>
