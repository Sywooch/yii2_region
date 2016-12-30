<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransSeats */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trans Seats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-seats-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Trans Seats') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info')
            ],
            [
                'attribute' => 'transSeatsType.name',
                'label' => Yii::t('app', 'Trans Seats Type')
            ],
            'name',
            'count',
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
        if ($providerTransPrice->totalCount) {
            $gridColumnTransPrice = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'transInfo.name',
                    'label' => Yii::t('app', 'Trans Info')
                ],
                'date_begin',
                'date_end',
                'price',
                'active',
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTransPrice,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Trans Price')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTransPrice
            ]);
        }
        ?>
    </div>
</div>
