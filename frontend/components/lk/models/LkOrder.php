<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 10.08.16
 * Time: 17:06
 */

namespace frontend\components\lk\models;

use common\models\HotelsPricing;
use common\models\SalOrder;
use common\models\SalOrderHasPerson;

class LkOrder extends SalOrder
{
    const SAL_STATUS_DEFAULT = 1;
    const SAL_ORDER_COUNT_PEOPLE = 1;

    public $country_id;
    //public $sal_order_status_id;
    public $city_id;
    //public $hotels_info_id;
    public $stars_id;
    //public $hotels_appartment_id;
    //public $trans_info_id;
    //public $userinfo_id;
    //public $tour_info_id;
    public $date_begin;
    public $date_end;
    public $from_site;
    public $date_range;
    public $type_of_food_id;

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

    public function calculateAppartmentPrice($appartmentId, $dayBegin, $dayEnd, $typeOfFood)
    {
        return $price = HotelsPricing::calculatedAppartmentPrice($appartmentId, $dayBegin, $dayEnd, $typeOfFood);

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
}