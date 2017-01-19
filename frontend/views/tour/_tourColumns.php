<?php

return [
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'country_id',
        'value' => function ($model) {
            $query = \common\models\Country::findOne(['id' => $model['country_id']]);
            return $query->name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'city_id',
        'value' => function ($model) {
            $query = \common\models\City::findOne(['id' => $model['city_id']]);
            return $query->name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'hotels_stars_id',
        'value' => function ($model) {
            $query = \common\models\HotelsStars::findOne(['id' => $model['hotels_stars_id']]);
            return $query->name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'appartment_name',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name_type_food',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'days',
    ],
    [
        //'class' => '\yii\bootstrap\Html',
        //'attribute' => 'tour_type_transport_id',
        'label' => 'Цена',
        'format' => 'raw',
        'value' => function ($model) {
            $date_begin = $_REQUEST['SearchAdvancedFilter']['date_begin'];
            $date_end = $_REQUEST['SearchAdvancedFilter']['date_end'];

            //TODO 2017-01-18 Полностью переделать логику работы сего чуда -
            //- дата начала иокончания в фильтре - это не даты тура -
            //- получить отдельно даты тура и их подсовывать
            $price = \frontend\models\GenTour::calcFullPrice($model['tour_info_id'],
                $model['hotels_appartment_id'], $model['type_food_id'], $date_begin, $date_end,
                $model['days'], 2, 0, array(), $model['date_begin']);
            if (count($price) > 0) {
                $str = "";
                foreach ($price as $key => $value) {
                    //TODO Доделать отображение цены заказа
                    if ($key >= 0 && $key < 5) {
                        $str .= \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                            'style' => 'min-width: 70px;']);
                        switch ($key) {
                            case 0:
                                $str .= \yii\bootstrap\Html::tag('p', 'Только <br> проживание');
                                $value['to'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Туда') : $str .= "";
                                $value['out'] != null ? $str .= \yii\bootstrap\Html::tag('div', 'Обратно') : $str .= "";
                                $str .= \yii\bootstrap\Html::tag('p', $value['price'] . ' руб.');
                                $str .= \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                    'lk/reservation/choose-tour',
                                    'tour_info_id' => $model['tour_info_id'],
                                    'hotels_appartment_id' => $model['hotels_appartment_id'],
                                    'hotels_type_of_food_id' => $model['type_food_id'],
                                    'country_id' => $model['country_id'],
                                    'city_id' => $model['city_id'],
                                    'date_begin' => $model['date_begin'],
                                    'days' => $model['days'],
                                ])
                                );
                                break;
                            case 1:
                                $str .= \yii\bootstrap\Html::tag('p', 'Автобус');
                                $str .= \yii\bootstrap\Html::tag('p', $value['price'] . ' руб.');
                                $str .= \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                    'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                                    'hotels_appartment_id' => $model['hotels_appartment_id'],
                                    'hotels_type_of_food_id' => $model['type_food_id'],
                                    'trans_info_id' => 1,
                                    //'trans_way_id' => $value['to'],
                                    'trans_route' => $value['to'],
                                    'trans_info_id_reverse' => 1,
                                    //'trans_way_id_reverse' => $value['out'],
                                    'trans_route_reverse' => $value['out'],
                                    'country_id' => $model['country_id'],
                                    'city_id' => $model['city_id'],
                                    'date_begin' => $model['date_begin'],
                                    'days' => $model['days'],
                                ])
                                );
                                break;
                            case 2:
                                $str .= \yii\bootstrap\Html::tag('p', 'Поезд');
                                $str .= \yii\bootstrap\Html::tag('p', $value['price'] . ' руб.');
                                $str .= \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                    'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                                    'hotels_appartment_id' => $model['hotels_appartment_id'],
                                    'hotels_type_of_food_id' => $model['type_food_id'],
                                    'trans_info_id' => 2,
                                    'trans_way_id' => $value['to'],
                                    'trans_info_id_reverse' => 2,
                                    'trans_way_id_reverse' => $value['out'],
                                    'country_id' => $model['country_id'],
                                    'city_id' => $model['city_id'],
                                    'date_begin' => $model['date_begin'],
                                    'days' => $model['days'],
                                ])
                                );
                                break;
                            case 3:
                                $str .= \yii\bootstrap\Html::tag('p', 'Самолет');
                                $str .= \yii\bootstrap\Html::tag('p', $value['price'] . ' руб.');
                                $str .= \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                    'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                                    'hotels_appartment_id' => $model['hotels_appartment_id'],
                                    'hotels_type_of_food_id' => $model['type_food_id'],
                                    'trans_info_id' => 3,
                                    'trans_way_id' => $value['to'],
                                    'trans_info_id_reverse' => 3,
                                    'trans_way_id_reverse' => $value['out'],
                                    'country_id' => $model['country_id'],
                                    'city_id' => $model['city_id'],
                                    'date_begin' => $model['date_begin'],
                                    'days' => $model['days'],
                                ])
                                );
                                break;
                            case 4:
                                $str .= \yii\bootstrap\Html::tag('p', 'Только <br> проживание');
                                $str .= \yii\bootstrap\Html::tag('p', $value['price'] . ' руб.');
                                $str .= \yii\bootstrap\Html::a('Заказ', \yii\helpers\Url::to([
                                    'lk/reservation/choose-tour', 'tour_info_id' => $model['tour_info_id'],
                                    'hotels_appartment_id' => $model['hotels_appartment_id'],
                                    'hotels_type_of_food_id' => $model['type_food_id'],
                                    'country_id' => $model['country_id'],
                                    'city_id' => $model['city_id'],
                                    'date_begin' => $model['date_begin'],
                                    'days' => $model['days'],
                                ])
                                );
                                break;
                            default:
                                $str .= \yii\bootstrap\Html::tag('p', 'Нет <br> доступных <br>туров');
                                break;
                        }
                        $str .= \yii\bootstrap\Html::endTag('div');
                    } elseif ($key == 0) {

                    }
                }
                //$price = 0;
            } else {
                $str = \yii\bootstrap\Html::tag('p', '0 руб.');
            }
            return $str;
        }
    ],


];
