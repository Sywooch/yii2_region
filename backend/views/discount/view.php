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
            'years',
            'date_add',
            'date_edit',
            'active',
            //'hotels_info_id',
        ],
    ]) ?>

</div>
