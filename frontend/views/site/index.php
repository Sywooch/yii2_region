<?php
use dmstr\bootstrap\Tabs;

/* @var $this yii\web\View */
$this->title = 'Лайв Тур Вояж';
?>
<div class="site-index">
    <div class="body-content">
        <div style="display: table;">
            <div class="col-md-4 col-xs-12 panel panel-primary" style="display: table-row">
                <?php $this->beginBlock('filtertours'); ?>
                <div class="filter find" style="display: table-cell">
                    <?php
                    $hic = \Yii::$app->createController('tour');
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
                echo $this->render('banner');

                ?>
            </div>
        </div>


        <div class="col-md-9 col-sm-12 col-xs-12 hotels-lists" style="float: right;">
            <?php
            echo $hic[0]->actionTop();
            ?>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12 news-form">
            <?php
            $news = \Yii::$app->createController('news');
            echo $news[0]->actionNewsList();
            //$article = Yii::$app->createController('\cinghie\articles\controllers\ItemsController');


            ?>
        </div>


    </div>
</div>
