<?php
use yii\helpers\Html;
use frontend\controllers\HotelsInfoController;
use kartik\form\ActiveForm;
use \dmstr\bootstrap\Tabs;

/* @var $this yii\web\View */
$this->title = 'Лайв Тур Вояж';
?>
<div class="container site-index">
    <div class="body-content">
        <div class="row" style="display: table;">
            <div class="col-md-4 col-xs-12 panel panel-primary" style="display: table-row">
                <?php $this->beginBlock('filtertours'); ?>
                <div class="filter find" style="display: table-cell">
                    <?php
                    $hic = \Yii::$app->createController('hotels');
                    echo $hic[0]->actionFilter();
                    ?>
                </div>
                <?php $this->endBlock(); ?>

                <?php $this->beginBlock('booking'); ?>
                <div class="booking">
                    <p style="font-size: 1.5em; height: 327px; display: block; position: relative; text-align: center; padding-top: 90px;">
                        <em>
                            Продажа Авиа/ЖД билетов временно недоступна, за подробной информацией обращаться по телефону: <br /><strong>8 (4752) 71-93-25</strong>.
                        </em>
                    </p>
                </div>
                <?php $this->endBlock(); ?>
                <?=
                Tabs::widget(
                    [
                        'encodeLabels' => false,
                        'items' => [[
                            'label' => Yii::t('app', 'Filter tours'),
                            'content' => $this->blocks['filtertours'],
                            'active' => true,
                        ],
                            [
                                'label' => Yii::t('app', 'Booking'),
                                'content' => $this->blocks['booking'],
                                'active' => false,
                            ],
                        ]
                    ]
                );
                ?>
            </div>
            <div class="col-md-8" style="display: table-row">
                <?= \yii\bootstrap\Carousel::widget([
                    'items'=>[
                        [
                            'content' => '<img src="'.Yii::$app->homeUrl.'images/banners/banner1.jpg" />',
                            'caption' => 'Лайф Тур Вояж. Автобусные туры к морю',
                            'options'=>[
                                'style' => 'max-width:100%; max-height:380px',
                            ],
                        ],
                        [
                            'content' => '<img src="'.Yii::$app->homeUrl.'images/banners/banner2.jpg" />',
                            'caption' => 'Лайф Тур Вояж. Оператор Позитивного отдыха',
                            'options'=>[
                                'style' => 'max-width:100%; max-height:380px',
                            ],
                        ],
                    ],
                    'controls' => [
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-left']),
                        Html::tag('span', '', ['class' => 'glyphicon glyphicon-chevron-right']),
                    ],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <?php
            echo $hic[0]->actionTop();
            ?>
        </div>

    </div>
</div>
