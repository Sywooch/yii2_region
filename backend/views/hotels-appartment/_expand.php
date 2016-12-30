<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'HotelsAppartment')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Hotels Appartment Has Hotels Type Of Food')),
        'content' => $this->render('_dataHotelsAppartmentHasHotelsTypeOfFood', [
            'model' => $model,
            'row' => $model->hotelsAppartmentHasHotelsTypeOfFoods,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Hotels Pricing')),
        'content' => $this->render('_dataHotelsPricing', [
            'model' => $model,
            'row' => $model->hotelsPricings,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Sal Order')),
        'content' => $this->render('_dataSalOrder', [
            'model' => $model->salOrders]),
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
