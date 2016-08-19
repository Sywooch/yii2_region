<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 17.08.16
 * Time: 5:47
 */
use yii\helpers\Html;

?>

<div class="item-view">
    <header>
        <h1><?= Html::encode($model->title) ?></h1>
        <time pubdate datetime="<?= $model->created ?>"></time>
        <?php if ($model->image): ?>
            <figure>
                <img class="img-responsive center-block img-rounded" src="<?= $model->getImageUrl() ?>"
                     alt="<?= $model->title ?>" title="<?= $model->title ?>">
                <?php if ($model->image_caption): ?>
                    <figcaption class="center-block">
                        <?= $model->image_caption ?>
                    </figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>
    </header>
    <?php if ($model->introtext): ?>
        <div class="intro-text">
            <?= $model->introtext ?>
        </div>
        <div class="btn btn-group">
            <?= Html::a(Yii::t('app', 'Details'), ['news/view', 'id' => $model->id], ['class' => 'btn btn-primary  pull-right', 'type' => 'button']) ?>
        </div>
    <?php endif; ?>
</div>
<div class="clear">
    <hr>
</div>

