<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusSchemeSeats */
?>
<div class="bus-scheme-seats-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'count',
        ],
    ]) ?>

</div>
