<?php

use yii\helpers\Html;
use cinghie\articles\assets\ArticlesAsset;

// Load Articles Assets
ArticlesAsset::register($this);
$asset = $this->assetBundles['cinghie\articles\assets\ArticlesAsset'];

?>

<article class="item-view">
    <header>
        <h1><?= Html::encode($this->title) ?></h1>
        <time pubdate datetime="<?= $model->created ?>"></time>
        <?php if ($model->image): ?>
            <figure>
                <img class="img-responsive center-block img-rounded" src="<?= $model->getImageUrl() ?>" alt="<?= $this->title ?>" title="<?= $this->title ?>">
                <?php if ($model->image_caption): ?>
                    <figcaption class="center-block">
                        <?= $model->image_caption ?>
                    </figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>
    </header>
    <?php if ($model->fulltext): ?>
        <div class="full-text">
            <?= $model->fulltext ?>
        </div>
    <?php endif; ?>
</article>
