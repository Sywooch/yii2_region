<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrderStatus */
?>
<div class="sal-order-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'color',
        ],
    ]) ?>

</div>
