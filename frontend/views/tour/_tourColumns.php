<?php

return [
    [
        'label' => 'Дата заезда',
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'selected_date',
    ],
    [
        'label' => 'Отель',
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
    ],
    [
        'label' => 'Страна прибытия',
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'country_id',
        'value' => function ($model) {
            $query = \common\models\Country::findOne(['id' => $model['country_id']]);
            return $query->name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Город прибытия',
        'attribute' => 'city_id',
        'value' => function ($model) {
            $query = \common\models\City::findOne(['id' => $model['city_id']]);
            return $query->name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Категория отеля',
        'attribute' => 'hotels_stars_id',
        'value' => function ($model) {
            $query = \common\models\HotelsStars::findOne(['id' => $model['hotels_stars_id']]);
            return $query->name;
        },
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Номер',
        'attribute' => 'appartment_name',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Тип питания',
        'attribute' => 'name_type_food',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'label' => 'Кол-во дней',
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
                $model['hotels_appartment_id'], $model['type_food_id'], $model['selected_date'], $model['selected_date'],
                $model['days'], 2, 0, array(), $model['selected_date']);
            if (is_array($price) && count($price) > 0) {
                $str = "";
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
                else{
                    $str = \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                        'style' => 'min-width: 70px;']);
                    $str .= \yii\bootstrap\Html::tag('p', 'Тур недоступен');
                    $str .= \yii\bootstrap\Html::endTag('div');
                }
                //$price = 0;
            }
            else{
                $str = \yii\bootstrap\Html::beginTag('div', ['class' => 'panel panel-primary zakaz-tour',
                    'style' => 'min-width: 70px;']);
                $str .= \yii\bootstrap\Html::tag('p', 'Нет <br> доступных <br>туров');
                $str .= \yii\bootstrap\Html::endTag('div');
            }
            return $str;
        }
    ],


];
