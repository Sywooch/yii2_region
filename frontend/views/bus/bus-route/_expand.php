<?php
use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'BusRoute')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Bus Route Has Bus Route Point')),
        'content' => $this->render('_dataBusRouteHasBusRoutePoint', [
            'model' => $model,
            'row' => $model->busRouteHasBusRoutePoints,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Bus Way')),
        'content' => $this->render('_dataBusWay', [
            'model' => $model,
            'row' => $model->busWays,
        ]),
    ],
];
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false,
    'class' => 'tes',
    'pluginOptions' => [
        'bordered' => true,
        'sideways' => true,
        'enableCache' => false
    ],
]);
?>
