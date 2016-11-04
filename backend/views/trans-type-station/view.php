<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransTypeStation */
?>
<div class="trans-type-station-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'date_add',
            'date_edit',
        ],
    ]) ?>

</div>
