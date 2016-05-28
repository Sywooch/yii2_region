<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HotelsCharacterItem */
?>
<div class="hotels-character-item-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'value:ntext',
            
            [
                'format' => 'html',
                'attribute' => 'hotels_character_id',
                'value' => ($model->getHotelsCharacter()->one() ? Html::a($model->getHotelsCharacter()->one()->name, ['hotels-character/view', 'id' => $model->getHotelsCharacter()->one()->id,]) : '<span class="label label-warning">?</span>'),
            ],
            'metrics:ntext',
            [
                'format' => 'html',
                'attribute' => 'hotels_info_id',
                'value' => ($model->getHotelsInfo()->one() ? Html::a($model->getHotelsInfo()->one()->name, ['hotels-info/view', 'id' => $model->getHotelsInfo()->one()->id,]) : '<span class="label label-warning">?</span>'),
            ],
            'date_add',
            'date_edit',
            [
                'attribute'=> 'active',
                'label'=>'Активный?',
                'format' => 'raw',
                'type' =>DetailView::INPUT_SWITCH,
                'value'=>$model->active ? '<span class="label label-success">Активный</span>' : '<span class="label label-danger">Неактивный</span>',
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
