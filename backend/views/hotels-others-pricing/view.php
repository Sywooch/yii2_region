<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsOthersPricing */
?>
<div class="hotels-others-pricing-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hotels_info_id',
            'price',
            'type_price',
            'active',
            'date_begin',
            'date_end',
            'hotels_others_pricing_type_id',
        ],
    ]) ?>

</div>
