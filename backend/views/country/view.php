<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
?>
<div class="country-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'name',
            'full_name',
            'code2',
            'code3',
        ],
    ]) ?>

</div>
