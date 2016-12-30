<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransInfo')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Sal Basket')),
        'content' => $this->render('_dataSalBasket', [
            'model' => $model,
            'row' => $model->salBaskets,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trans Price')),
        'content' => $this->render('_dataTransPrice', [
            'model' => $model,
            'row' => $model->transPrices,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trans Seats')),
        'content' => $this->render('_dataTransSeats', [
            'model' => $model,
            'row' => $model->transSeats,
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
