<?php

use yii\helpers\Html;
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
    <hr>
    <p>Вокзалы следования (путь):</p>
    <?= Html::ul(\common\models\TransStation::getTransStationRelationField($model->id),['label' => 'Trans Station']) ?>

</div>
