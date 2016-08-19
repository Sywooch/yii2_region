<?php
use dmstr\bootstrap\Tabs;
use yii\helpers\Html;

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
                            Продажа Авиа/ЖД билетов временно недоступна, за подробной информацией обращаться по
                            телефону: <br/><strong>8 (4752) 71-93-25</strong>.
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
                <?php
                $banners[] = [
                    'caption' => 'Лайф Тур Вояж. Автобусные туры к морю',
                    'content' => '<img src="' . Yii::$app->homeUrl . 'images/banners/banner1.jpg" />',
                    'options' => [
                        'style' => 'max-width:100%; max-height:380px',
                    ],
                ];
                ?>
                <?= \yii\bootstrap\Carousel::widget([
                    'items' => [
                        [
                            'content' => '<img src="' . Yii::$app->homeUrl . 'images/banners/banner1.jpg" />',
                            'caption' => 'Лайф Тур Вояж. Автобусные туры к морю',
                            'options' => [
                                'style' => 'max-width:100%; max-height:380px',
                            ],
                        ],
                        [
                            'content' => '<img src="' . Yii::$app->homeUrl . 'images/banners/banner2.jpg" />',
                            'caption' => 'Лайф Тур Вояж. Оператор Позитивного отдыха',
                            'options' => [
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 news-form">
                        <?php
                        $news = \Yii::$app->createController('news');
                        echo $news[0]->actionNewsList();
                        ?>
                    </div>

                    <div class="col-md-9 hotels-lists">
                        <?php
                        echo $hic[0]->actionTop();
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
