<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsOthersPricingType */
?>
<div class="hotels-others-pricing-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date_add',
            'date_edit',
            'active',
            'description:ntext',
        ],
    ]) ?>

</div>
