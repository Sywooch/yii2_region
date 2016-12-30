<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;

$items = [
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'TransSeats')),
        'content' => $this->render('_detail', [
            'model' => $model,
        ]),
    ],
    [
        'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode(Yii::t('app', 'Trans Price')),
        'content' => $this->render('_dataTransPrice', [
            'model' => $model,
            'row' => $model->transPrices,
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
