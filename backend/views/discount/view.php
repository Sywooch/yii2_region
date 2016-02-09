<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Discount */
?>
<div class="discount-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'discount',
            'type_price',
            'date_begin',
            'date_end',
            'active',
            'hotels_info_id',
        ],
    ]) ?>

</div>
