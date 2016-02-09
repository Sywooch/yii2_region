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
            'gps_parallel:ntext',
            'gps_meridian:ntext',
            'address_id',
            'trans_type_station_id',
        ],
    ]) ?>

</div>
