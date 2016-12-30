<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TransSeatsType */
?>
<div class="trans-seats-type-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'date_add',
            'date_edit',
            //'created_by',
            //'updated_by',
            //'lock',
        ],
    ]) ?>

</div>
