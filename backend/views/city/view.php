<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\City */
?>
<div class="city-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'country.name',
                'label' => Yii::t('app', 'Country')
            ],
            'name',
            'description:ntext',
            [
                'type' => \kartik\grid\BooleanColumn::className(),
                'attribute' => 'active',
            ],
            'date_add',
            'date_edit',


        ],
    ]) ?>

</div>
