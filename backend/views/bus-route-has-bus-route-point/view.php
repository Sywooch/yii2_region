<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusRouteHasBusRoutePoint */
?>
<div class="bus-route-has-bus-route-point-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bus_route_id',
            'bus_route_point_id',
            'first_point',
            'end_point',
        ],
    ]) ?>

</div>
