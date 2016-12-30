<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourComposition */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tour Compositions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-composition-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Tour Composition') . ' ' . Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'name',
            'hotel',
            'transport',
            'food',
            'transfer',
            'insure',
            'visa',
            'excursion',
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
        if ($providerTourInfo->totalCount) {
            $gridColumnTourInfo = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'name:ntext',
                'date_begin',
                'date_end',
                'days',
                'active',
                [
                    'attribute' => 'hotelsInfo.name',
                    'label' => Yii::t('app', 'Hotels Info')
                ],
                [
                    'attribute' => 'city.name',
                    'label' => Yii::t('app', 'City')
                ],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerTourInfo,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode(Yii::t('app', 'Tour Info')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
                'toggleData' => false,
                'columns' => $gridColumnTourInfo
            ]);
        }
        ?>
    </div>
</div>
