<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsPricing */
?>
<div class="hotels-pricing-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hotels_appartment_id',
            'hotels_appartment_hotels_info_id',
            'hotels_others_pricing_id',
            'date',
            'full_price',
            'discount_id',
            'name:ntext',
            'date_begin',
            'date_end',
            'active',
            'hotels_type_of_food_id',
        ],
    ]) ?>

</div>
