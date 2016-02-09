<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsInfo */
?>
<div class="hotels-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'address_id',
            'country',
            'GPS:ntext',
            'links_maps:ntext',
            'hotels_stars_id',
        ],
    ]) ?>

</div>
