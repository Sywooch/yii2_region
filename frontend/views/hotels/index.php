<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Гостиницы');
?>

<div class="container-fluid">
    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_hotel',
        'pager'=>[
            'options'=>[
                'class' => 'pagination',
            ],
        ],
        'summary' => '',
    ]) ?>
</div>
