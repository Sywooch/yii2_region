<?php
use yii\helpers\Html;

?>

<div class="col-md-4 panel panel-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="image">
                    <?= Html::img($model->getImage()->getUrl('120x'),['alt' => $model->name])?>
                </div>
            </div>
            <div class="col-md-7">
                <div class="name">
                    <strong><?= Html::tag('p',$model->name) ?></strong>

                </div>
                <div class="stars">
                    <strong><?= Yii::t('app', 'HotelsStar') ?>:</strong>
                    <?= \yii\helpers\ArrayHelper::getValue(\common\models\HotelsStars::findOne(['id'=> $model->hotels_stars_id]), 'name') ?>
                </div>
                <div class="country">
                    <strong><?= Yii::t('app','Country') ?>:</strong>
                    <?= \yii\helpers\ArrayHelper::getValue(\common\models\Country::findOne(['id'=> $model->country]),'name') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="description">
                    <?= \yii\helpers\StringHelper::truncate($model->description,150) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <strong><?= Yii::t('app', 'Prices appartment from') ?>:</strong>
                <div class="price">
                    <?= \yii\helpers\ArrayHelper::getValue(\common\models\HotelsAppartment::find()
                    ->andFilterWhere(['hotels_info_id'=>$model->id])
                    ->andFilterWhere(['active'=>1])
                    ->orderBy('price')->one(), 'price') ?> руб.
                </div>
            </div>
            <div class="pull-right">
                <div class="btn btn-primary">
                    <?=
                    Html::a(Yii::t('app', 'Details'), ['hotels/details', 'id' => $model->id],['class'=>'link'])
                     ?>
                </div>
            </div>
        </div>
    </div>

</div>
