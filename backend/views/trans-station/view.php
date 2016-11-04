<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransStation */
?>
<div class="trans-station-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'description:ntext',
            [
                'attribute' => 'transTypeStation.name',
                'label' => Yii::t('app', 'Trans type station'),
            ],
            'gps_parallel:ntext',
            'gps_meridian:ntext',
            'address_id',

            'date_add',
            'date_edit',
        ],
    ]) ?>

</div>
