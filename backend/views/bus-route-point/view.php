<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoutePoint */
?>
<div class="bus-route-point-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'gps_point_m:ntext',
            'gps_point_p:ntext',
            'active',
            'description:ntext',
            'date',
        ],
    ]) ?>

</div>
