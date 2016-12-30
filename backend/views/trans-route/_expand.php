<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransRoute')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trans Info')),
        'content' => $this->render('_dataTransInfo', [
            'model' => $model,
            'row' => $model->transInfos,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trans Route Has Trans Station')),
        'content' => $this->render('_dataTransRouteHasTransStation', [
            'model' => $model,
            'row' => $model->transRouteHasTransStations,
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
