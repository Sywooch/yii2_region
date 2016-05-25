<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mirocow\yandexmaps\Map as YandexMap;
use mirocow\yandexmaps\Canvas as YandexCanvas;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoutePoint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-route-point-form">
    <?php
    $map = new YandexMap('yandex_map', [
        'center' => [$model->gps_point_m, $model->gps_point_p],
        
        'zoom' => 10,
        // Enable zoom with mouse scroll
        'behaviors' => array('default', 'scrollZoom'),
        'type' => "yandex#map",
    ],
        [
            // Permit zoom only fro 9 to 11
            'minZoom' => 4,
            'maxZoom' => 18,
            'controls' => [
                /*"new ymaps.control.SmallZoomControl()",*/
                /*"\"smallZoomControl\"",*/
                "new ymaps.control.TypeSelector(['yandex#map', 'yandex#satellite'])",
            ],
            'events' => [
                'click' => "function(e) {
                var coords = e.get('coords'); 
                $('#busroutepoint-gps_point_m').val(coords[0].toPrecision(6));
                $('#busroutepoint-gps_point_p').val(coords[1].toPrecision(6));
                }",

            ]
        ]
    );
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
    <?= $form->field($model, 'gps_point_m')->textInput() ?>

    <?= $form->field($model, 'gps_point_p')->textInput() ?>

    <?= YandexCanvas::widget([
        'htmlOptions' => [
            'style' => 'height: 400px;',
        ],
        'map' => $map,
    ])?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
