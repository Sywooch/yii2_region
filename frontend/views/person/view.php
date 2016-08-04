<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Person */
?>
<div class="person-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstname',
            'lastname',
            'secondname',
            'date_new',
            'date_edit',
            'passport_ser',
            'passport_num',
            'contacts:ntext',
            'other:ntext',
        ],
    ]) ?>

</div>
