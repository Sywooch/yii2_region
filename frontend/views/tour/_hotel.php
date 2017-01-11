<?php
use yii\helpers\Html;

$hotels = $model->hotelsInfo;
$price = 'Нет направления';
if ($hotels) {
    $pricing = $hotels->hotelsPricings;
    $price = 0;
//$pricing1 = $pricing->hotelsPayPeriods;
    foreach ($pricing as $key => $value) {
        $p = 0;
        $p = $value->getHotelsPayPeriods()->orderBy('price')->one();
        if ($price == 0 || $price > $p->price) {
            $price = $p->price;
        }
    }
}


/*
$hotels = \common\models\HotelsInfo::findOne(['id'=>$model['hotels_info_id']]);
$price = \common\models\HotelsPricing::find()->andWhere(['hotels_info_id'=>$model['hotels_info_id']])
    ->orderBy('price')->one();
*/
?>

<div class="col-md-4">
    <div class="panel panel-primary hotel">
        <div class="container-fluid">
            <div class="row hotel-vhead">
                <div class="col-lg-5 col-md-12">
                    <div class="image">
                        <?= Html::img($hotels->getImage()->getUrl('100x'), ['alt' => $hotels->name]) ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 mgt-10">
                    <div class="name">
                        <strong><?= $hotels->name ?></strong>

                    </div>
                    <div id="reviewStars">
                        <?php
                        $count_star = \yii\helpers\ArrayHelper::getValue(\common\models\HotelsStars::findOne(['id' => $hotels->hotels_stars_id]), 'count_stars');
                        for ($i = 0; $i < $count_star; $i++) {
                            ?>
                            <label id="star-<?= $i ?>"></label>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="country">
                        <strong><?= Yii::t('app', 'Country') ?>:</strong>
                        <?= \yii\helpers\ArrayHelper::getValue(\common\models\Country::findOne(['id' => $hotels->country]), 'name') ?>
                    </div>
                    <div class="city">
                        <strong><?= Yii::t('app', 'Курорт') ?>:</strong>
                        <?= \yii\helpers\ArrayHelper::getValue(\common\models\City::findOne(['id' => $hotels->city_id]), 'name') ?>
                    </div>
                </div>
            </div>
            <div class="row hotel-vdesc">
                <div class="col-md-12 mgt-10">
                    <div class="description">
                        <?= \yii\helpers\StringHelper::truncate(strip_tags($hotels->description), 150) ?>
                    </div>
                </div>
            </div>
            <div class="row hotel-vbut">
                <div class="col-md-8 mgt-10">
                    <strong><?= Yii::t('app', 'Prices appartment from') ?>:</strong>
                    <div class="price">
                        <?= $price ?> руб.
                    </div>
                </div>
                <div class="pull-right">
                    <div class="btn btn-primary">
                        <?=
                        Html::a(Yii::t('app', 'Reserv'), ['lk/reservation/choose-tour', 'hotels_info_id' => $hotels->id], ['class' => 'link'])
                        ?>
                    </div>
                    <div class="btn btn-primary">
                        <?=
                        Html::a(Yii::t('app', 'Details'), ['hotels/details', 'id' => $hotels->id], ['class' => 'link'])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
