<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */
?>
<div class="sal-order-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'sal_order_status_id',
            'hotels_info',
            'transport_info',
            'persons',
            'child',
            'date_begin',
            'date_end',
            'enable',
            'full_price',
            'insurance_info:ntext',
            'hotels_info_id',
            'trans_info_id',
            'userinfo_id',
            'tour_info_id',
            'hotels_appartment_id',
            'hotels_appartment_hotels_info_id',
        ],
    ]) ?>

</div>
