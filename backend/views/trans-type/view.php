<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransType */
?>
<div class="trans-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            [
                'attribute' => 'transTypeStation.name',
                'label' => Yii::t('app', 'Trans type station'),
            ],
            'date_add',
            'date_edit',


        ],
    ]) ?>

</div>
