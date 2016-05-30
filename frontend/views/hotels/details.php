<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var common\models\HotelsInfo $model
 */
$copyParams = $model->attributes;

$this->title = $model->getAliasModel() . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->getAliasModel(true), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'View');
?>
<div class="giiant-crud hotels-info-view panel panel-info">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= $model->getAliasModel() ?>
        <strong>
            "<?= $model->name ?>"        </strong>
    </h1>


    <div class="clearfix">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'format'=>'html',
                    'attribute' => 'Изображение',
                    'value'=> Html::img($model->getImage()->getUrl('120x'),['alt' => $model->name])
                ],
                'name:ntext',
                'address',
                [
                    'format' => 'html',
                    'attribute' => 'country',
                    'value' => ($model->getCountry()->one() ?
                        Html::tag('div',$model->getCountry()->one()->name) :
                        '<span class="label label-warning">?</span>'),
                ],
// generated by schmunk42\giiant\generators\crud\providers\RelationProvider::attributeFormat
                [
                    'format' => 'html',
                    'attribute' => 'hotels_stars_id',
                    'value' => ($model->getHotelsStars()->one() ? Html::tag('div', $model->getHotelsStars()->one()->name) : '<span class="label label-warning">?</span>'),
                ],
            ],
        ]); ?>


    </div>
