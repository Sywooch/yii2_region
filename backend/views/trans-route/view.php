<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransRoute */
?>
<div class="trans-route-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_add',
            'date_edit',
            'active',
            'begin_point:ntext',
            'end_point:ntext',
        ],
    ]) ?>

</div>
