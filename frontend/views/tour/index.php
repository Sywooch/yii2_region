<?php
/* @var $this yii\web\View */
use kartik\helpers\Html;

$this->title = Yii::t('app', 'Лайф Тур Вояж - оператор позитивного отдыха');
//$model['points_to'] = $points
?>


<?php
if ((Yii::$app->getRequest()->getPathInfo() == 'hotels') or
    (Yii::$app->getRequest()->getPathInfo() == 'hotels/index') or
    (Yii::$app->getRequest()->getPathInfo() == 'hotels/') or
    (Yii::$app->getRequest()->getPathInfo() == 'tour') or
    (Yii::$app->getRequest()->getPathInfo() == 'tour/index') or
    (Yii::$app->getRequest()->getPathInfo() == 'tour/')
) {
    ?>
<div class="col-md-3 col-xs-12 panel panel-default">
        <div class="filters-hotels">
            <?php
            echo $this->render('_search_page_hotels', ['model' => $searchModel]);
            ?>
        </div>
    </div>
<div class="result-hotels">
    <?php

    //Формируем столбцы (так как последний столбец нужно менять, его будем добавлять вручную

    if ($type == \frontend\models\SearchAdvancedFilter::TYPE_FILTER_TOUR){
        $lPrice = "Стоимость тура";
        $lDate = "Дата заезда в гостиницу";
    }
    else{
        $lPrice = "Цена за номер";
        $lDate = "Заселение в гостиницу";
    }
    $columns = [
            [
                'label' => $lDate,
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'selected_date',
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'label' => 'Отель',
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'name',
                'value'=>function ($model, $key, $index, $widget) {
        $hotel = new \common\models\HotelsInfo(['id'=>$model['hotels_info_id']]);
                    $s = "<div>".
                        Html::img($hotel->getImage()->getUrl('120x'))
                        ."</div>";
                    return $s. \yii\bootstrap\Html::a($model['name'],
                        ['/hotels/details','id'=>$model['hotels_info_id']],
                        ['title'=>'Детальная информация о гостинице']);
                },
                'format' => 'raw',
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'label' => 'Страна прибытия',
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'country_id',
                'value' => function ($model) {
                    $query = \common\models\Country::findOne(['id' => $model['country_id']]);
                    return $query->name;
                },
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Курорт',
                'attribute' => 'city_id',
                'value' => function ($model) {
                    $query = \common\models\City::findOne(['id' => $model['city_id']]);
                    return $query->name;
                },
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Категория отеля',
                'attribute' => 'hotels_stars_id',
                'value' => function ($model) {
                    $query = \common\models\HotelsStars::findOne(['id' => $model['hotels_stars_id']]);
                    return $query->name;
                },
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Номер',
                'attribute' => 'appartment_name',
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Питание',
                'attribute' => 'name_type_food',
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'label' => 'Кол-во дней',
                'attribute' => 'days',
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
            ],
            [
                //'class' => '\yii\bootstrap\Html',
                //'attribute' => 'tour_type_transport_id',
                //Формируем наименования полей в зависимости от типа возвращаемого результата(
        //в фильтре может быть результат поиска либо туров, либо отелей)
                'label' => $lPrice,
                'headerOptions' => ['class'=>"site-grid-filter-header-cell"],
                'format' => 'raw',
                'value' => function ($model) {
                    $date_begin = $_REQUEST['SearchAdvancedFilter']['date_begin'];
                    $date_end = $_REQUEST['SearchAdvancedFilter']['date_end'];

                    //TODO 2017-01-18 Полностью переделать логику работы сего чуда -
                    //- дата начала иокончания в фильтре - это не даты тура -
                    //- получить отдельно даты тура и их подсовывать
                    //Проверяем, выводятся туры, или только гостиницы
                    if (key_exists('tour_info_id',$model)){
                        $price = \frontend\models\GenTour::calcFullPrice($model['tour_info_id'],
                            $model['hotels_appartment_id'], $model['type_food_id'], $model['selected_date'], $model['selected_date'],
                            $model['days'], 1, 0, array(), $model['selected_date'],
                            false, false, false, false,
                            true, $model['city_to'], $model['city_out']);
                        $str = "";
                        if (is_array($price) && count($price) > 0) {

                            $tran = false;
                            $hotelPrice = 0;
                            foreach ($price as $key => $value) {
                                if (isset($value[0]) && $value[0] === true){
                                    //TODO Доделать отображение цены заказа
                                    if ($key > 0 && $key < 5) {
                                        $tran = true;
                                        $str .= \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                                            'style' => 'min-width: 70px;']);

                                        switch ($key) {
                                            case 0:
                                                $str .= \yii\bootstrap\Html::tag('p', 'Только <br> проживание');
                                                break;
                                            case 1:
                                                $str .= \yii\bootstrap\Html::tag('p', 'Автобус');
                                                $value['to'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Туда') : $str .= "";
                                                $value['out'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Обратно') : $str .= "";
                                                break;
                                            case 2:
                                                $str .= \yii\bootstrap\Html::tag('p', 'Поезд');
                                                $value['to'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Туда') : $str .= "";
                                                $value['out'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Обратно') : $str .= "";
                                                break;
                                            case 3:
                                                $str .= \yii\bootstrap\Html::tag('p', 'Самолет');
                                                $value['to'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Туда') : $str .= "";
                                                $value['out'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Обратно') : $str .= "";
                                                break;
                                            case 4:
                                                $str .= \yii\bootstrap\Html::tag('p', 'Только <br> проживание');
                                                break;
                                            default:
                                                $str .= \yii\bootstrap\Html::tag('p', 'Нет <br> доступных <br>туров');
                                                break;
                                        }
                                        $str .= \yii\bootstrap\Html::tag('p', $value['price'] . ' руб.');
                                        $str .= \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                            'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                                            'hotels_appartment_id' => $model['hotels_appartment_id'],
                                            'hotels_type_of_food_id' => $model['type_food_id'],
                                            'trans_info_id' => $key,
                                            'trans_way_id' => $value['to'],
                                            'trans_info_id_reverse' => $key,
                                            'trans_way_id_reverse' => $value['out'],
                                            'country_id' => $model['country_id'],
                                            'city_id' => $model['city_id'],
                                            'date_begin' => $model['selected_date'],
                                            'days' => $model['days'],
                                            'tourist_count'=> 2,
                                        ])
                                        );
                                        $str .= \yii\bootstrap\Html::endTag('div');
                                    }
                                }
                                else{
                                    if ($hotelPrice == 0){
                                        $hotelPrice = $value['hotelPrice'];
                                    }
                                }
                            }

                            //Ни одного значения транспорта нет, просто выводим стоимость проживания
                            if (($hotelPrice > 0) && ($tran === false)){
                                $str .= \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                                    'style' => 'min-width: 70px;']);
                                $str .= \yii\bootstrap\Html::tag('p', 'Только <br> проживание');
                                $str .= \yii\bootstrap\Html::tag('p', $hotelPrice . ' руб.');

                                $str .= \yii\bootstrap\Html::tag('p', \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                    'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                                    'hotels_appartment_id' => $model['hotels_appartment_id'],
                                    'hotels_type_of_food_id' => $model['type_food_id'],
                                    'trans_info_id' => 4,
                                    'trans_info_id_reverse' => 4,
                                    'country_id' => $model['country_id'],
                                    'city_id' => $model['city_id'],
                                    'date_begin' => $model['selected_date'],
                                    'days' => $model['days'],
                                    'tourist_count' => 2,
                                ]))
                                );
                                $str .= \yii\bootstrap\Html::endTag('div');
                            }
                            /*else{
                                $str = \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                                    'style' => 'min-width: 70px;']);
                                $str .= \yii\bootstrap\Html::tag('p', 'Тур недоступен');
                                $str .= \yii\bootstrap\Html::endTag('div');
                            }*/
                            //$price = 0;
                        }
                        /*else{
                            $str = \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                                'style' => 'min-width: 70px;']);
                            $str .= \yii\bootstrap\Html::tag('p', 'Нет <br> доступных <br>туров');
                            $str .= \yii\bootstrap\Html::endTag('div');
                        }*/
                        return $str;
                    }
                    //Выводим только гостиницы
                    else{
                        /*$price = \common\models\HotelsPayPeriod::calculatedAppartmentPrice(
                            $model['hotels_appartment_id'], $model['selected_date'],
                            $model['days'], $model['type_food_id']);*/
                        $str = "";
                        /*if ($price > 0) {*/
                        $str .= \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                            'style' => 'min-width: 70px;']);
                        $str .= \yii\bootstrap\Html::tag('p', 'Только <br> проживание');
                        //$str .= \yii\bootstrap\Html::tag('p', $price . ' руб.');
                        $str .= \yii\bootstrap\Html::tag('p', $model['price'] . ' руб.');

                        $str .= \yii\bootstrap\Html::tag('p', \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                            'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                            'hotels_appartment_id' => $model['hotels_appartment_id'],
                            'hotels_type_of_food_id' => $model['type_food_id'],
                            'trans_info_id' => 4,
                            'trans_info_id_reverse' => 4,
                            'country_id' => $model['country_id'],
                            'city_id' => $model['city_id'],
                            'date_begin' => $model['selected_date'],
                            'days' => $model['days'],
                            'tourist_count' => 1,
                        ]))
                        );
                        $str .= \yii\bootstrap\Html::endTag('div');
                        /*}
                        else{
                            $str = \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                                'style' => 'min-width: 70px;']);
                            $str .= \yii\bootstrap\Html::tag('p', 'Тур недоступен');
                            $str .= \yii\bootstrap\Html::endTag('div');
                        }*/
                        //$price = 0;
                        return $str;
                    }

                }
            ],
        ];

    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns,//require(__DIR__ . '/_tourColumns.php'),
        'condensed' => true,
        'resizableColumns' => false,
        'bordered' => false,

        //'showHeader' => false,
    ]);
}
    else {
    ?>
    <div class="hotels">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_hotel',
            'pager' => [
                'options' => [
                    'class' => 'pagination',
                ],
            ],
            'summary' => '',
        ]); ?>

        <?php
        }
        ?>
    </div>
