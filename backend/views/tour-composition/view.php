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
        <div class="col-sm-8">
            <h2><?= Yii::t('app', 'Tour Composition') . ' ' . Html::encode($this->title) ?></h2>
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
            'name',
            'hotel:boolean',
            'transport:boolean',
            'food:boolean',
            'transfer:boolean',
            'insure:boolean',
            'visa:boolean',
            'excursion:boolean',
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
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tour-info']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Tour Info')),
                ],
                'columns' => $gridColumnTourInfo
            ]);
        }
        ?>
    </div>
</div>
