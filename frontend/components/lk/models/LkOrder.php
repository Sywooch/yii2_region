<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 10.08.16
 * Time: 17:06
 */

namespace frontend\components\lk\models;

use common\models\BusInfo;
use common\models\BusReservation;
use common\models\BusWay;
use common\models\HotelsPayPeriod;
use common\models\SalOrder;
use common\models\SalOrderHasPerson;
use common\models\TransPrice;
use common\models\TransReservation;
use common\models\TransSeats;
use Yii;

class LkOrder extends SalOrder
{
    const SAL_STATUS_DEFAULT = 1;
    const SAL_ORDER_COUNT_PEOPLE = 1;

    public $no_request = true; // Переменная определяет, создается страница заново или предопределенные параметры имеются

    public $country_id;
    //public $sal_order_status_id;
    public $city_id;
    //public $hotels_info_id;
    public $stars_id;
    //public $hotels_appartment_id;
    //public $trans_info_id;
    //public $user_id;
    //public $tour_info_id;
    /*public $date_begin;
    public $date_end;*/
    public $from_site;
    public $date_range;
    public $type_of_food_id;

    public $trans_route;

    public $country_out_id;
    public $city_out_id;

    //public $trans_info_id_reverse;
    public $trans_route_reverse;

    public $tourist_count;
    public $child_count;
    public $child_years;
    public $days;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['date', 'date_begin', 'date_end', 'date_add', 'date_edit','hotel_date_begin', 'hotel_date_end',
                    'tourist_count', 'child_count', 'child_years', 'trans_info_id',
                    'trans_info_id_reverse', 'city_id', 'country_id', 'stars_id', 'days'
                ], 'safe'],
                [['sal_order_status_id', 'user_id', /*'tour_info_id',*/ 'hotels_type_of_food_id'], 'required'],
                [['sal_order_status_id', 'enable', 'hotels_info_id', 'hotels_appartment_id',
                    'trans_info_id',
                    'trans_way_id',
                    'trans_info_id_reverse',
                    'trans_way_id_reverse',
                    'user_id', 'tour_info_id',
                    'created_by', 'updated_by', 'lock', 'hotels_type_of_food_id','hotels_appartment_full_sale', 'hotels_pay_period_id'], 'integer'],
                [['full_price'], 'number'],
                [['insurance_info'], 'string'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'sal_order_status_id' => Yii::t('app', 'Sal Order Status ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'enable' => Yii::t('app', 'Enable'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'hotels_type_of_food_id' => Yii::t('app', 'Hotels Type Of Food Id'),
            'user_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'full_price' => Yii::t('app', 'Full Price'),
            'insurance_info' => Yii::t('app', 'Insurance Info'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'trans_route' => Yii::t('app', 'Маршрут следования'),
            'trans_info_id_reverse' => Yii::t('app', 'Trans Info ID'),
            'trans_route_reverse' => Yii::t('app', 'Обратный маршрут следования'),
            'country_id' => Yii::t('app', 'Страна'),
            'city_id' => Yii::t('app', 'City Id'),
            'country_out_id' => Yii::t('app', 'Страна'),
            'city_out_id' => Yii::t('app', 'City Id'),
            'stars_id' => Yii::t('app', 'Stars Id'),

            'tourist_count' => Yii::t('app', 'Количество туристов'),
            'child_count' => Yii::t('app', 'из них детей'),
            'child_years' => Yii::t('app', 'Возраст детей'),
            'lock' => Yii::t('app', 'Lock'),


        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        $model = $this->getHotelsInfo();
        if ($model->one() != null) {
            $this->country_id = $model->one()->country;
            return \common\models\Country::findOne(['id' => $this->country_id]);
        } else {
            return false;
        }
    }

    public function getStars()
    {
        $model = $this->getHotelsInfo();
        if ($model->one() != null) {
            $this->stars_id = $model->one()->hotels_stars_id;
            return \common\models\HotelsStars::findOne(['id' => $this->stars_id]);
        } else {
            return false;
        }
    }

    public function getHotelsInfoByAppartmentId($appartmentId)
    {
        $query = $this->getHotelsAppartment();
        $query->select('hotels_info_id')
            ->andWhere(['id' => $appartmentId]);
        return $query->one();
    }

    public function getTourInfoByHotelsId($hotelsId)
    {
        $query = $this->getTourInfo();
        $query->select('id')
            ->andWhere(['hotels_info_id' => $hotelsId]);
        return $query->one();
    }

    //Получить страну из отеля
    public function getCountryByHotels($hotelsId)
    {
        $query = $this->getHotelsInfo();
        $query->select('country')
            ->andWhere(['id' => $hotelsId]);
        return $query->one();
    }


    public function getHotelsByCountry($idCountry)
    {
        $model = new \common\models\HotelsInfo();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->findAll(['country_id' => $idCountry, 'active' => 1]);
    }

    public function getAppertmentsByHotel($idHotel)
    {
        $model = new \common\models\HotelsAppartment();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->findAll(['hotels_info_id' => $idHotel]);
    }

    public function calculateAppartmentPrice($appartmentId, $dayBegin, $countDay, $typeOfFood)
    {
        return $price = HotelsPayPeriod::calculatedAppartmentPrice($appartmentId, $dayBegin, $countDay, $typeOfFood);
    }

    /**
     * Фукнция загружает все данные текущего заказа
     * @param $salOrderId
     * @return bool
     */
    public static function getAllPersons($salOrderId)
    {
        if (isset($salOrderId)) {
            $query = SalOrderHasPerson::find()->andWhere(['sal_order_id' => $salOrderId]);
            return $query;
        }
        return false;
    }

    public static function getChildPersons($salOrderId)
    {
        if (isset($salOrderId)) {
            $query = SalOrderHasPerson::find()
                ->innerJoin('person', 'person.id = sal_order_has_person.person_id')
                ->andWhere(['sal_order_id' => $salOrderId])
                ->andWhere(['person.child' => 1]);
            return $query;
        }
        return false;
    }

    public static function getChildPersonsYears($salOrderId)
    {
        if (isset($salOrderId)) {
            $query = self::getChildPersons($salOrderId);
            //$query->select(['birthday']);
            $years = [];
            foreach ($query->each() as $key => $value){
                $person = $value->person;
                $date_begin = new \DateTime($person->birthday);
                $date_end = new \DateTime();
                $years[] = $date_begin->diff($date_end)->y;
            }
            return $years;
        }
        return false;
    }

    public static function reservationBusWay($busWayId, $person = array())
    {
        if (count($person) > 0) {
            $maxNumberSeats = intval(BusReservation::getMaxSeats($busWayId));
            $busInfo = BusWay::findOne($busWayId)->bus_info_id;
            $maxBusSeats = BusInfo::findOne($busInfo)->seat;

            $currentNumberSeats = $maxNumberSeats + 1;
            //Если количество людей превышает количество мест, останавливаем функцию
            if (($currentNumberSeats + count($person)) >= $maxBusSeats){
                return false;
            }
            unset($busReserv);
            foreach ($person as $key => $value) {

                $busReserv = new BusReservation();
                $busReserv->bus_info_id = $busInfo;
                $busReserv->bus_way_id = $busWayId;
                $busReserv->active = 1;
                $busReserv->person_id = $value['person_id'];
                $busReserv->number_seat = $currentNumberSeats;
                $busReserv->date = date('Y-m-d H:i:s');

                $busReserv->save();

                $currentNumberSeats++;
            }
            return true;
        }
        return false;
    }

    public static function reservationTransportWay($transPriceId, $person = array())
    {
        if (count($person) > 0) {
            $maxNumberSeats = intval(\common\models\TransReservation::getMaxNumberSeats($transPriceId));
            $seatId = TransPrice::findOne($transPriceId)->trans_seats_id;
            $maxBusSeats = TransSeats::findOne($seatId)->count;
            $currentNumberSeats = $maxNumberSeats + 1;
            unset($busReserv);
            foreach ($person as $key => $value) {
                $busReserv = new TransReservation();
                //$busReserv->bus_info_id = $busInfo;
                $busReserv->trans_price_id = $transPriceId;
                $busReserv->active = 1;
                $busReserv->person_id = $value['id'];
                $busReserv->number_seats = $currentNumberSeats;
                $busReserv->date = date('Y-m-d H:i:s');

                $busReserv->save();

                $currentNumberSeats++;
            }
            return true;
        }
        return false;
    }

    public function loadTrans(){
        $this->trans_way_id = $_REQUEST['LkOrder']['trans_route'];
        $this->trans_info_id_reverse = $_REQUEST['LkOrder']['trans_info_id_reverse'];
        $this->trans_way_id_reverse = $_REQUEST['LkOrder']['trans_route_reverse'];
    }


    public function genInvoiceTable($salId){
        $res = array();
        $order = SalOrder::findOne(['id' => $salId]);
        $appartment = $order->hotelsAppartment;
        $count = $order->getPeople()->count();
        $countChild = self::getChildPersons($salId)->count();
        $childYears = self::getChildPersonsYears($salId);

        $dBegin = new \DateTime($order->hotel_date_begin);
        $dEnd = new \DateTime($order->hotel_date_end);
        $countDay = $dEnd->diff($dBegin)->days;
        $hotelPrice =  \common\models\HotelsPayPeriod::calculatedAppartmentPrice($appartment->id,
            $dBegin,$countDay,$order->hotels_type_of_food_id, $count, $countChild, $childYears,$salId);


        //Заполняем названия гостиниц
        //индекс 0 - отели
        //      1 - транспорт
        //      2 - прочие цены (тура)
        $res = array(
            array(
                'name' => $order->hotelsInfo->name . " / " . $appartment->name . " / дней: " . $countDay,
                'count' => $count,
                'ed' => 'чел.',
                'full_price' => $hotelPrice,
            ),
            array(
                'name' => $order->getTransWayName(),
                'count' => $count,
                'ed' => 'чел.',
                'full_price' => $order->getTransWay()[1]->price * $count,
            ),
            array(
                'name' => $order->getTransWayReverseName(),
                'count' => $count,
                'ed' => 'чел.',
                'full_price' => $order->getTransWayReverse()[1]->price * $count,
            ),
        );


        return $res;
    }
}