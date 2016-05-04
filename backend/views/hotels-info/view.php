<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsInfo */
?>
<div class="hotels-info-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'name:ntext',
            'address',
            'country',
            'GPS:ntext',
            'links_maps:ntext',
            'hotels_stars_id',
        ],
    ]) ?>
    <?= \yii\helpers\Html::img($model->image,['width'=>'150px']) ?>

</div>
