<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusRoutePoint */

?>
<div class="bus-route-point-create">
    <?php if (is_null($model->gps_point_m)){
        $model->gps_point_m = '55.76';
    };
    if (is_null($model->gps_point_p)){
        $model->gps_point_p = '37.64';
    };?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
