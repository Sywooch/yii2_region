<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransPrice */
?>
<div class="trans-price-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'price',
            'date_add',
            'date_edit',
            'trans_price_type_id',
        ],
    ]) ?>

</div>
