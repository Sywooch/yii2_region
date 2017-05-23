<?php


use cinghie\articles\assets\ArticlesAsset;

// Load Articles Assets
ArticlesAsset::register($this);
$asset = $this->assetBundles['cinghie\articles\assets\ArticlesAsset'];

?>

    <div class="articles">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_article',
            'pager' => [
                'options' => [
                    'class' => 'pagination',
                ],
            ],
            'summary' => '',
        ]) ?>
    </div>



