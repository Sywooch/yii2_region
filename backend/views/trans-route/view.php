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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Trans Route') . ' ' . Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?=
            Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('app', 'PDF'),
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('app', 'Will open the generated PDF file in a new window')
                ]
            ) ?>
            <?= Html::a(Yii::t('app', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
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
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-trans-info']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Trans Info')),
        ],
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
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-trans-route-has-trans-station']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Trans Route Has Trans Station')),
                ],
                'columns' => $gridColumnTransRouteHasTransStation
            ]);
        }
        ?>
    </div>
</div>
