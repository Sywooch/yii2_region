<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'BusReservation')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    /*[
'label' => '<i class="glyphicon glyphicon-book"></i> '. Html::encode(Yii::t('app', 'Bus Reservation Has Person')),
'content' => $this->render('_dataBusReservationHasPerson', [
'model' => $model,
'row' => $model->busReservationHasPeople,
]),
],*/
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
