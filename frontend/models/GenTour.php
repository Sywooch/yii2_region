<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 09.01.17
 * Time: 6:31
 */

namespace frontend\models;

use common\models\HotelsInfo;
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


    /**
     * Функция получает по одному маршруту "туда" и "обратно"
     * @param $tour_info_id - идентификатор тура
     * @param $date_start - дата заезда в гостиницу
     * @param $date_end - дата выезда из гостиницы
     * @param $hotel - параметр определяет, в гостиницу поедем или это только автобусный тур (экскурсии, паломнические поездки).
     * В зависимости от этого
     * @return array
     */
    public static function getTourTransport($tour_info_id, $date_start, $date_end, $hotel = true,
                            $trans_info_id = false, $trans_way_id = false, $trans_info_id_reverse = false, $trans_way_id_reverse = false)
    {
        $route = array();
        //Получаем только конкретные маршруты и цены
        //TODO Добавить проверку забронированных маршрутов
        if (($trans_info_id && $trans_way_id) || ($trans_info_id_reverse && $trans_way_id_reverse)){
            if ($trans_info_id && $trans_way_id){
                if ($trans_info_id == 1){
                    $query = \common\models\BusWay::find()->active()
                        ->andWhere(['id'=>$trans_way_id])->one()
                    ;
                }
                elseif ($trans_info_id == 2 || $trans_info_id == 3){
                    $query = \common\models\TransPrice::find()->active()
                        ->andWhere(['id'=>$trans_way_id])->one();
                }
                $route['to'] = $query;
                $route['to_type'] = $trans_info_id;
            }
            else{
                $route['to'] = false;
            }
            if ($trans_info_id_reverse && $trans_way_id_reverse){

                if ($trans_info_id_reverse == 1){
                    $query_reverse = \common\models\BusWay::find()->active()
                        ->andWhere(['id'=>$trans_way_id_reverse])->one()
                    ;
                }
                elseif ($trans_info_id_reverse == 2 || $trans_info_id_reverse == 3){
                    $query_reverse = \common\models\TransPrice::find()->active()
                        ->andWhere(['id'=>$trans_way_id_reverse])->one();
                }
                $route['out'] = $query_reverse;
                $route['out_type'] = $trans_info_id_reverse;
            }
            else{
                $route['out'] = false;
            }
            $route[0]=1;
        }

        else {
            $trans = new TourInfo(['id' => $tour_info_id]);
            $transType = $trans->getTourInfoHasTourTypeTransports();
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
                    $query_to = clone $query;
                    $query_out = clone $query;
                    if ($hotel === true) {
                        //Получаем маршруты "Туда":
                        $route[$transTour]['to'] = $query_to->andWhere(["DATE_FORMAT(`date_end`,'%Y-%m-%d')" => $date_start])->one();
                        //Получаем маршруты "Обратно":
                        $route[$transTour]['out'] = $query_out->andWhere(["DATE_FORMAT(`date_begin`,'%Y-%m-%d')" => $date_end])->one();
                    } else {
                        //Получаем маршруты "Туда":
                        $route[$transTour]['to'] = $query->andWhere(["DATE_FORMAT(`date_begin`,'%Y-%m-%d')" => $date_start])->one();
                        //Получаем маршруты "Обратно":
                        $route[$transTour]['out'] = $query->andWhere(["DATE_FORMAT(`date_end`,'%Y-%m-%d')" => $date_end])->one();
                    }
                }
            }

            $route[0] = 2;
        }
        return $route;
    }

    public static function calcFullPrice($tourInfoId, $hotelsAppartmentId, $typeOfFood, $hotelsBegin, $hotelsEnd, $countDay,
            $countTourist, $countChild, $childYears, $transDateBegin, $trans_info_id = false, $trans_way_id = false,
             $trans_info_id_reverse = false,$trans_way_id_reverse = false, $hotel_enable = true)
    {
        $fullPrice = array();

        $dateBegin = new \DateTime($hotelsBegin);
        $dateBegin = $dateBegin->format('Y-m-d');
        $hotelsBegin = $dateBegin;
        if ($countDay > 0){
            $dateEnd = new \DateTime($hotelsBegin);
            $dateEnd->add(new \DateInterval('P'.$countDay.'D'));
        }
        else{
            $dateEnd = new \DateTime($hotelsEnd);
        }
        $hotelsEnd = $dateEnd->format('Y-m-d');

        $hotelPrice = HotelsPayPeriod::calculatedAppartmentPrice($hotelsAppartmentId, $dateBegin, $countDay, $typeOfFood, $countTourist, $countChild, $childYears);
        $transPrice = self::getTourTransport($tourInfoId, $hotelsBegin, $hotelsEnd, $hotel_enable,
            $trans_info_id, $trans_way_id, $trans_info_id_reverse, $trans_way_id_reverse);

        $otherPrice = 0; //self::calcOtherPrice($tourInfoId);
        //формируем массив с ценой
        $typeT = $transPrice[0];
        unset ($transPrice[0]);
        if ($typeT === 1){

            //TODO Ошибка при формировании цены, проверить
            $transPriceTo = 0;
            $transPriceOut = 0;
            if ($transPrice['to']){
                $transPriceOut = $transPrice['to']->price;
            }
            if ($transPrice['out']){
                $transPriceOut = $transPrice['out']->price;
            }


            $fullPrice['price'] =
                $transPriceTo
                + $transPriceOut
                + $hotelPrice
                + $otherPrice;
        }

        elseif($typeT === 2) {
            $stop = false;
            foreach ($transPrice as $key => $value) {
                $price = ($value['to']->price ? $value['to']->price : 0) + ($value['out']->price ? $value['out']->price : 0);
                if ($price != 0){
                    $fullPrice[$key][0] = true;
                    $fullPrice[$key]['price'] = $price + $hotelPrice;
                    $fullPrice[$key]['to'] = $value['to']->id;
                    $fullPrice[$key]['out'] = $value['out']->id;
                }
                else{
                    $fullPrice[$key][0] = false;
                    $fullPrice[$key]['hotelPrice'] = $hotelPrice;
                }
            }
        }

        //Добавляем проверку на наличие скидок (акция раннего бронирования и горячие туры)
        $tourModel = TourInfo::findOne($tourInfoId);

        return $fullPrice;
    }

    /**
     * Рассчитываем стоимость всех дополнительных услуг
     * @param $hotelId - идентификатор отеля
     * @param $tourId - идентификатор тура
     * @return float - сумма дополнительных услуг
     */
    public function calcOtherPrice($tourId){
        $model = new GenTour();
        $hotelId = \common\models\TourInfo::findOne(['id'=>$tourId])->hotels_info_id;
        $result = floatval($model->hotelOthelPrice($hotelId)) + floatval($model->tourOtherPrice($tourId));
        return $result;
    }


    public function hotelOthelPrice($hotelId){
        $model = new HotelsInfo(['id'=>$hotelId]);
        $result = $model->getHotelsOthersPricings()->active();
        $price = 0;
        foreach ($result->each() as $key=>$value){
            $price += $value->price;
        }
        return $price;
    }

    public function tourOtherPrice($tourId){
        $model = new \common\models\TourInfo(['id'=>$tourId]);
        $result = $model->getTourOtherPricings()->active();
        $price = 0;
        foreach ($result->each() as $key=>$value){
            $price += $value->price;
        }
        return $price;
    }

}