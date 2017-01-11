<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 09.01.17
 * Time: 6:31
 */

namespace frontend\models;

use common\models\HotelsPayPeriod;
use common\models\TourInfo;
use Yii;

class GenTour extends \yii\db\ActiveRecord
{
    public $tour_info_id;
    public $hotels_info_id;
    public $name;
    public $days;
    public $price;
    public $name_type_food;
    public $hotels_stars_id;

    public $countryTo; //Страна прибытия (country -> id) +
    public $countryOut; //Страна отправления (country -> id)
    public $cityTo; //Город прибытия (city -> id - hotels_info -> city_id) +
    public $cityOut; //Город отправления (city -> id - tour_info -> city_id) +

    public $stars; //Звездность гостиниц (1, 2, 3 и т.д.) (hotels_stars -> id - hotels_info -> hotels_stars_id) +
    public $typeOfFood; //Тип питания (все включено, только завтрак и т.д.) (hotels_type_of_food -> id) +
    // hotels_appartment_has_hotels_type_of_food -> hotels_appartment_hotels_info_id)
    public $appartmentType; //Тип номера (стандарт, эконом и т.д.) (hotels_appartment_item -> id) +

    public $touristCount; //Количество туристов (для расчета нужного количества комнат)
    public $childCount; //Количество детей (должно быть меньше кол-ва туристов минимум на 1)
    public $birthdayChild; //Дата рождения ребенка, нужна для определения скидки.
    // (скидка не действует, если выбирается только проживание)
    //Для каждого тура скидка вбивается отдельно!!!

    public $tourTypes; //Тип тура (автобусный к морю, горячие) (tour_type -> id) +
    public $tourComposition; //Состав тура (все включено, проезд, трансфер и т.д.) (tour_composition -> id)
    //public $days; //Количество дней тура (tour_info -> days) +

    //tour_info->price - минимальная цена тура, расчитывается автоматически

    public $priceMin; //Минимальная цена тура (tour_info -> price) +
    public $priceMax; //Максимальная цена тура

    public $date_begin; //Начало периода, в который ищется начало тура (tour_info -> date_begin) +
    public $date_end; //Окончание периода, в который ищется начало тура (tour_info -> date_end) +

    public static function tableName()
    {
        return 'tour_info';
    }

    public function rules()
    {
        return [
            [['tour_info_id', 'hotels_info_id', 'days', 'hotels_stars_id'], 'integer'],
            [['price'], 'number'],
            [['name_type_food'], 'string'],
            [['name'], 'safe'],

        ];
    }


    public function attributeLabels()
    {
        return [
            'tour_info_id' => Yii::t('app', 'Tour info id'),
            'hotels_info_id' => Yii::t('app', 'Hotels info id'),
            'days' => Yii::t('app', 'Days'),
            'price' => Yii::t('app', 'Price'),
            'name_type_food' => Yii::t('app', 'Type of food'),
            'hotels_stars_id' => Yii::t('app', 'Hotels Stars'),
        ];
    }

    public static function getTourTransport($tour_info_id, $date_begin, $date_end)
    {
        $trans = new TourInfo(['id' => $tour_info_id]);
        $transType = $trans->getTourInfoHasTourTypeTransports();

        $route = array();
        //TODO Добавить проверку забронированных маршрутов
        foreach ($transType->all() as $key => $value) {
            $transTour = $value['tour_type_transport_id'];
            unset($query);
            if ($transTour == 1) {
                //Получаем автобусы, которые идут в конкретное время в конкретное место
                $query = \common\models\BusWay::find()->active();
            } elseif ($transTour == 2 or $transTour == 3) {
                //Получаем модель транспорта: поезда
                //Получаем поезд, который идет в конкретное время в конкретное место
                $query = \common\models\TransPrice::find()->active();
                $query->innerJoin('trans_info as ti', 'trans_price.trans_info_id = ti.id')
                    ->andWhere(['ti.trans_type_id' => $transTour]);
            }
            if ($transTour > 0 && $transTour < 4) {
                //Получаем маршруты "Туда":
                $route[$transTour]['to'] = $query->andWhere(['date_end' => $date_begin])->one();
                //Получаем маршруты "Обратно":
                $route[$transTour]['out'] = $query->andWhere(['date_begin' => $date_end])->one();
            }
        }
        return $route;
    }

    public static function calcFullPrice($tourInfoId, $hotelsAppartmentId, $typeOfFood, $hotelsBegin, $hotelsEnd, $countDay,
                                         $countTourist, $countChild, $childYears, $transDateBegin)
    {
        $fullPrice = array();
        $dateBegin = new \DateTime($hotelsBegin);
        $dateBegin = $dateBegin->format('Y-m-d');
        $hotelPrice = HotelsPayPeriod::calculatedAppartmentPrice($hotelsAppartmentId, $dateBegin, $countDay, $typeOfFood, $countTourist, $countChild, $childYears);
        $transPrice = self::getTourTransport($tourInfoId, $transDateBegin, $hotelsEnd);
        foreach ($transPrice as $key => $value) {
            $price = $value['to']->price ? $value['to']->price : 0 + $value['out']->price ? $value['out']->price : 0;
            $fullPrice[$key]['price'] = $price + $hotelPrice;
            $fullPrice[$key]['to'] = $value['to']->id;
            $fullPrice[$key]['out'] = $value['out']->id;
        }
        if (count($fullPrice) > 0 && $hotelPrice > 0) {
            $fullPrice[0] = $hotelPrice;
        }
        $otherPrice = 0;

        return $fullPrice;
    }

}