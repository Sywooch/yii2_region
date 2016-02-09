<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TourTypeTransport */
?>
<div class="tour-type-transport-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
        ],
    ]) ?>

</div>
