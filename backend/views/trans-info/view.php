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
            'trans_type_id',
            'name:ntext',
            'trans_route_id',
            'seats',
        ],
    ]) ?>

</div>
