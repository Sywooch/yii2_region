<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var common\models\BusRouteHasBusRoutePoint $model
*/

$this->title = 'Bus Route Has Bus Route Point ' . $model->bus_route_id . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => 'Bus Route Has Bus Route Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->bus_route_id, 'url' => ['view', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud bus-route-has-bus-route-point-update">

    <h1>
        <?= Yii::t('app', 'Bus Route Has Bus Route Point') ?>        <small>
                        <?= $model->bus_route_id ?>        </small>
    </h1>

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'bus_route_id' => $model->bus_route_id, 'bus_route_point_id' => $model->bus_route_point_id], ['class' => 'btn btn-default']) ?>
    </div>

    <?php echo $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
