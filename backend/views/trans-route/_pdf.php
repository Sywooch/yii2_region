<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransRoute */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-route-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Trans Route') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'date_begin',
            'date_end',
            'name:ntext',
            'active',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTransInfo->totalCount) {
            $gridColumnTransInfo = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'transType.name',
                    'label' => Yii::t('app', 'Trans Type')
                ],
                'name:ntext',
                'seats',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransInfo,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Trans Info')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTransInfo
            ]);
        }
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerTransRouteHasTransStation->totalCount) {
            $gridColumnTransRouteHasTransStation = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'transStation.name',
                    'label' => Yii::t('app', 'Trans Station')
                ],
                'position',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransRouteHasTransStation,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Trans Route Has Trans Station')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTransRouteHasTransStation
            ]);
        }
        ?>
    </div>
</div>
