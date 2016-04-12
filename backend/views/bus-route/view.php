<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\db\Query;
use yii\data\ActiveDataProvider;
/*use kartik\widgets\ */

/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bus Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-route-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        $brp = \common\models\BusRoutePoint::find()->innerJoin('bus_route_has_bus_route_point',
            'bus_route_has_bus_route_point.bus_route_point_id = bus_route_point.id')
            ->where(['bus_route_has_bus_route_point.bus_route_id' => $model->id]);


        /*$query = (new Query())->select('name')->from('bus_route_point')
            ->innerJoin('bus_route_has_bus_route_point',
                'bus_route_has_bus_route_point.bus_route_point_id = bus_route_point.id')
            ->where(['bus_route_has_bus_route_point.bus_route_id' => $model->id]);*/


    $brpName = ArrayHelper::map($brp->all(),'id','name');
    /*$dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);*/

    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',*/
            'name:ntext',
            'date:datetime',
            'date_begin:datetime',
            'date_end:datetime',

        ],
    ]) ?>

    <?php
    echo Html::checkboxList('BusRoutePoint', ['multiple' => true], $brpName)
    /*echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,

    ]);*/ ?>

</div>
