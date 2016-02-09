<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransPriceType */
?>
<div class="trans-price-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'description:ntext',
            'date_add',
            'date_edit',
            'active',
        ],
    ]) ?>

</div>
