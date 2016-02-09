<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusWay */
?>
<div class="bus-way-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'bus_info_id',
            'date_create',
            'date_begin',
            'date_end',
            'active',
            'ended',
            'bus_path_id',
        ],
    ]) ?>

</div>
