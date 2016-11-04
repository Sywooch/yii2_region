<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransInfo */
?>
<div class="trans-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            [
                'attribute' => 'transType.name',
                'label' => Yii::t('app', 'Trans type'),
            ],
            'transRoute.begin_point',
            'transRoute.end_point',
            'seats',
            'date_add',
            'date_edit',
        ],
    ]) ?>

</div>
