<?php
use yii\helpers\Html;
use frontend\controllers\HotelsInfoController;

/* @var $this yii\web\View */
$this->title = 'Лайв Тур Вояж';
?>
<div class="container site-index">
    <div class="body-content">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="filter find">
                        <?php
                        $hic = \Yii::$app->createController('hotels');
                        echo $hic[0]->actionFilter();

                        ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <?= Html::img('@web/images/banner.png',['style' => 'max-width:100%; max-height:380px']) ?>
                </div>
            </div>



        <div class="row">

            <?php  ?>
            <div class="col-lg-3">
                <?= Html::img('@web/images/hotels.png',['width' => '100px']) ?>


                <p>Информация о гостинице</p>
            </div>
            <div class="col-lg-3">

                <?= Html::img('@web/images/hotels.png',['width' => '100px']) ?>


                <p>Информация о гостинице</p>
            </div>
            <div class="col-lg-3">
                <?= Html::img('@web/images/hotels.png',['width' => '100px']) ?>


                <p>Информация о гостинице</p>
            </div>
            <div class="col-lg-3">
                <?= Html::img('@web/images/hotels.png',['width' => '100px']) ?>


                <p>Информация о гостинице</p>
            </div>
        </div>

    </div>
</div>
