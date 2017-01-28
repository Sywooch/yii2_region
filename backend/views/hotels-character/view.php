<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsCharacter */
$parent = \common\models\HotelsCharacter::findOne(['id'=>$model->parent_id]);
?>

<div class="hotels-character-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            [
                'format' => 'html',
                'attribute' => 'parent_id',
                'value' => ($parent->name ? \yii\bootstrap\Html::a($parent->name, ['hotels-character/view', 'id' => $parent->id,]) : '<span class="label label-warning">?</span>'),
            ],
            //'num_hierar',
            'date_add',
            'date_edit',
            [
                'attribute' => 'active',
                'type' => \kartik\detail\DetailView::INPUT_SWITCH,
                'format'=>'raw',
                'value'=>$model->active ? '<span class="label label-success">Да</span>' : '<span class="label label-danger">Нет</span>',
                'type'=>\kartik\detail\DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Да',
                        'offText' => 'Нет',
                    ]
                ],
            ],
        ],
    ]) ?>

</div>
