<?php

use yii\widgets\DetailView;
use mirocow\yandexmaps\Map as YandexMap;
use mirocow\yandexmaps\Canvas as YandexCanvas;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoutePoint */
?>
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
        
    ]
);
?>
<div class="bus-route-point-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'gps_point_m:ntext',
            'gps_point_p:ntext',
            'active',
            'description:ntext',
            'date',
        ],
    ]) ?>
    <?= YandexCanvas::widget([
        'htmlOptions' => [
            'style' => 'height: 400px;',
        ],
        'map' => $map,
    ])?>

</div>
