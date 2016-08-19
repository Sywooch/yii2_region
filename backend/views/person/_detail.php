<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Person */

?>
<div class="person-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->firstname) ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            'firstname',
            'lastname',
            'secondname',
            'date_new',
            'passport_ser',
            'passport_num',
            'birthday',
            'contacts:ntext',
            'other:ntext',
            'child',
            ['attribute' => 'lock', 'visible' => false],
            [
                'attribute' => 'gender.name',
                'label' => Yii::t('app', 'Gender'),
            ],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>