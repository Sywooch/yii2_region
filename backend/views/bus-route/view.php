<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusRoute */
?>
<div class="bus-route-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date',
            'date_begin',
            'date_end',
        ],
    ]) ?>

</div>
