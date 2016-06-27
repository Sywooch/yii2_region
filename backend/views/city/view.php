<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\City */
?>
<div class="city-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'date_add',
            'date_edit',
            'active',
        ],
    ]) ?>

</div>
