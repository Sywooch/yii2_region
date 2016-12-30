<?php
$items = [];
foreach (\common\models\Banner::bannerList() as $banner) {
    $items[] = [
        'caption' => $banner->text,
        'link' => $banner->link,
        'content' => '<img src="' . $banner->file . '" />',
        'options' => [
            'style' => 'max-width:100%; height:380px',
        ],
    ];
}

echo \yii\bootstrap\Carousel::widget([
    'items' => $items,
    'controls' => [
        \yii\bootstrap\Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-left']),
        \yii\bootstrap\Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-right']),
    ],
]) ?>

