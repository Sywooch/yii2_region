<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusDriver */
?>
<div class="bus-driver-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'FIO:ntext',
            'number_license:ntext',
            'active:boolean',
            'date',
            'first:boolean',
            'bus_info_id',
            [
                'attribute' => 'busInfo.name',
                'label' => Yii::t('app', 'Bus Info')
            ],
        ],
    ]) ?>

</div>
