<?php
/**
 * Ваучер, который выдается туристам
 * Описывается абсолютно вся информация по туру
 */

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalOrder */
$this->title = $model->id;


?>
<div class="container-fluid">
    <div class="row">
        <header>
            <div class="logo col-sm-5 col-md-5 col-lg-5 col-xs-5">
                <img class="logo-element" src="<?= Yii::$app->homeUrl ?>images/logo.png"/>

            </div>
            <div class="pull-right col-sm-5 col-md-5 col-lg-5 col-xs-5">
                <p class="h5 text-right">
                    Россия Геленджик, Туапсе,Анапа, Крым, Сочи , Абхазия +7(4752)-71-93-25
                    круглосуточная служба поддержки туристов в России: 8-910-(752)-00-33
                </p>
            </div>
            <div class="clear"></div>
        </header>
    </div>
</div>

<div class="sal-order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?php echo Yii::t('app', 'Voucher') . ' №' . Html::encode($this->title); ?>
            (<span style="font-size: 75%"><?php echo Yii::t('app', 'Rezervation') . ' №' . Html::encode($model->num_rezerv); ?></span>)
            </h2>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'salOrderStatus.name',
                'label' => Yii::t('app', 'Sal Order Status')
            ],
            'date_begin',
            'date_end',
            [
                'attribute' => 'tourInfo.name',
                'label' => Yii::t('app', 'Tour Info')
            ],
            [
                'attribute' => 'hotelsInfo.name',
                'label' => Yii::t('app', 'Hotels Info')
            ],

            [
                'attribute' => 'hotelsStar.name',
                'label' => Yii::t('app', 'Hotels Star')
            ],
            [
                'attribute' => 'hotelsAppartment.name',
                'label' => Yii::t('app', 'Hotels Appartment')
            ],
            [
                'attribute' => 'hotelsTypeOfFood.name',
                'label' => Yii::t('app', 'Hotels Type Of Food')
            ],
            [
                'attribute' => 'transInfo.name',
                'label' => Yii::t('app', 'Trans Info')
            ],


            'full_price',
            'insurance_info:ntext',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn,
            'options' => [

            ],
        ]);
        ?>
    </div>

    <div class="row">
        <?php
        if ($providerSalOrderHasPerson->totalCount) {
            $gridColumnSalOrderHasPerson = [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'gender.name',
                    'label' => Yii::t('app', 'Gender'),
                ],
                [
                    'attribute' => 'person.lastname',
                    'label' => Yii::t('app', 'Lname')
                ],
                [
                    'attribute' => 'person.firstname',
                    'label' => Yii::t('app', 'Fname')
                ],
                [
                    'attribute' => 'person.birthday',
                    'label' => Yii::t('app', 'Birthday')
                ],
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo Gridview::widget([
                'dataProvider' => $providerSalOrderHasPerson,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => Html::encode('Persons/' . Yii::t('app', 'Sal Order Has Person')),
                ],
                'panelHeadingTemplate' => '<h4>{heading}</h4>',
                'toggleData' => false,
                'columns' => $gridColumnSalOrderHasPerson
            ]);
        }
        ?>
    </div>

    <?php
    if (is_object($providerTransportTo) && $providerTransportTo->allModels[0] != 0) {
        ?>
        <div class="row">
            <div class="panel panel-info">
                <div class="pane-body">
                    <?php
                    if ($providerTypeTransportTo == \common\models\TourTypeTransport::TYPE_BUS){
                        $gridColumnTransportTo = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'name:ntext',
                            [
                                'attribute' => 'busInfo.name',
                                'label' => Yii::t('app', 'Bus Info')
                            ],
                            'date_begin',
                            'date_end',
                            'price',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                    }
                    elseif ($providerTypeTransportTo == \common\models\TourTypeTransport::TYPE_TRAIN ||
                        $providerTypeTransportTo == \common\models\TourTypeTransport::TYPE_AVIA){
                        $gridColumnTransportTo = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                                'attribute' => 'transInfo.name',
                                'label'=> Yii::t('app', 'Trans Info'),
                            ],
                            [
                                'attribute' => 'transType.name',
                                'label' => Yii::t('app', 'Trans Type'),
                            ],
                            [
                                'attribute' => 'transSeats.name',
                                'label' => Yii::t('app', 'Trans Seats')
                            ],
                            'date_begin',
                            'date_end',
                            'price',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                    }
                    echo Gridview::widget([
                        'dataProvider' => $providerTransportTo,
                        'columns' => $gridColumnTransportTo,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Транспорт "Туда"')),
                        ],
                        'panelHeadingTemplate' => '<h4>{heading}</h4>',
                        'toggleData' => false,
                        /*
                        'pjax' => true,
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sal-order-has-person']],
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Транспорт "Туда"')),
                        ],

                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'hover' => true,
                        'showPageSummary' => false,
                        'persistResize' => false,
                        */
                    ]);
                    ?>

                </div>
            </div>
        </div>
    <?php } ?>

    <?php
    if (is_object($providerTransportOut) && $providerTransportOut->allModels[0] != 0) {
        ?>
        <div class="row">
            <div class="panel panel-info">
                <div class="pane-body">
                    <?php
                    if ($providerTypeTransportOut == \common\models\TourTypeTransport::TYPE_BUS){
                        $gridColumnTransportOut = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'name:ntext',
                            [
                                'attribute' => 'busInfo.name',
                                'label' => Yii::t('app', 'Bus Info')
                            ],
                            'date_begin',
                            'date_end',
                            'price',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                    }
                    elseif ($providerTypeTransportOut == \common\models\TourTypeTransport::TYPE_TRAIN ||
                        $providerTypeTransportOut == \common\models\TourTypeTransport::TYPE_AVIA){
                        $gridColumnTransportOut = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                                'attribute' => 'transInfo.name',
                                'label'=> Yii::t('app', 'Trans Info'),
                            ],
                            [
                                'attribute' => 'transType.name',
                                'label' => Yii::t('app', 'Trans Type'),
                            ],
                            [
                                'attribute' => 'transSeats.name',
                                'label' => Yii::t('app', 'Trans Seats')
                            ],
                            'date_begin',
                            'date_end',
                            'price',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                    }
                    echo Gridview::widget([
                        'dataProvider' => $providerTransportOut,
                        'columns' => $gridColumnTransportOut,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Транспорт "Обратно"')),
                        ],
                        'panelHeadingTemplate' => '<h4>{heading}</h4>',
                        'toggleData' => false,
                        /*
                        'pjax' => true,
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sal-order-has-person']],
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Транспорт "Туда"')),
                        ],

                        'bordered' => true,
                        'striped' => true,
                        'condensed' => true,
                        'responsive' => true,
                        'hover' => true,
                        'showPageSummary' => false,
                        'persistResize' => false,
                        */
                    ]);
                    ?>

                </div>
            </div>
        </div>
    <?php } ?>

</div>
