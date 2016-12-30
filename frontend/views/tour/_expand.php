<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TourInfo')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Sal Basket')),
        'content' => $this->render('_dataSalBasket', [
            'model' => $model->salBaskets]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Sal Order')),
        'content' => $this->render('_dataSalOrder', [
            'model' => $model->salOrders]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Tour Info Has Tour Type')),
        'content' => $this->render('_dataTourInfoHasTourType', [
            'model' => $model,
            'row' => $model->tourInfoHasTourTypes,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Tour Info Has Tour Type Transport')),
        'content' => $this->render('_dataTourInfoHasTourTypeTransport', [
            'model' => $model,
            'row' => $model->tourInfoHasTourTypeTransports,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Tour Price')),
        'content' => $this->render('_dataTourPrice', [
            'model' => $model,
            'row' => $model->tourPrices,
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
