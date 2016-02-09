<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusInfo */
?>
<div class="bus-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'gos_number',
            'seat',
            'date',
            'active',
        ],
    ]) ?>

</div>
