<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsAppartmentItem */
?>
<div class="hotels-appartment-item-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'count_beds',
            'active',
            'date_add',
            'date_edit',
        ],
    ]) ?>

</div>
