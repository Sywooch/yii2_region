<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 03.08.16
 * Time: 18:29
 */

namespace frontend\components\lk\models;

use common\models\HotelsPricing;
use common\models\SalOrder;
use Yii;
use yii\db\ActiveRecord;

class Reservation extends ActiveRecord
{
    const SAL_STATUS_DEFAULT = 1;

    public $country_id;
    public $sal_order_status_id;
    public $city_id;
    public $hotels_info_id;
    public $stars_id;
    public $hotels_appartment_id;
    public $trans_info_id;
    public $user_id;
    public $tour_info_id;
    public $date_begin;
    public $date_end;
    public $from_site;
    public $date_range;
    public $type_of_food_id;
    public $trans_route;

    public static function tableName()
    {
        return '{{%sal_order}}';
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
            'country_id' => Yii::t('app', 'Страна'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'user_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'full_price' => Yii::t('app', 'Full Price'),
            'insurance_info' => Yii::t('app', 'Insurance Info'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'trans_route' => Yii::t('app', 'Маршрут следования'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    public function rules()
    {
        return
            [
                [['country_id', 'sal_order_status_id', 'city_id', 'hotels_info_id', 'stars_id',
                    'hotels_appartment_id', 'trans_info_id', 'user_id', 'tour_info_id'], 'integer'],
                [['sal_order_status_id', 'hotels_info_id', 'hotels_appartment_id', 'user_id', 'tour_info_id',
                    'date_begin', 'date_end', 'type_of_food_id'], 'required'],
                [['date_begin', 'date_end'], 'safe'],
                [['date_begin', 'date_end'], 'date', 'format' => 'php:Y-m-d'],
                [['from_site'], 'boolean'],
            ];
    }

    public function processChooseTour()
    {
        //$model = new Reservation();
        $model = new SalOrder();
        return $model;
    }

    public function getSalOrder()
    {
        return $this->hasMany(SalOrder::className(), ['id' => 'sal_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartment()
    {
        return $this->hasOne(\common\models\HotelsAppartment::className(), ['id' => 'hotels_appartment_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrderStatus()
    {
        return $this->hasOne(\common\models\SalOrderStatus::className(), ['id' => 'sal_order_status_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfo()
    {
        return $this->hasOne(\common\models\TourInfo::className(), ['id' => 'tour_info_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransInfo()
    {
        return $this->hasOne(\common\models\TourTypeTransport::className(), ['id' => 'trans_info_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //TODO Переделать на получение турагентств
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrderHasPeople()
    {
        return $this->hasMany(\frontend\models\bus\SalOrderHasPerson::className(), ['sal_order_id' => 'id'])->inverseOf('salOrder');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(\frontend\models\bus\Person::className(), ['id' => 'person_id'])->viaTable('sal_order_has_person', ['sal_order_id' => 'id']);
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
        $query->select('id')->active()
            ->andWhere(['hotels_info_id' => $hotelsId]);
        return $query->one();
    }


    public function getHotelsByCountry($idCountry)
    {
        $model = $this->getHotels(null,$idCountry);
        //$model = new \common\models\HotelsInfo();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->all();
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
     * Функция отбирает гостиницы только в активных(по состоянию на текущую дату) турах
     * @param null $tour_info_id
     * @param null $country_id
     * @param null $city_id
     * @param null $stars_id
     * @param null $appartment_id
     * @return \common\models\HotelsInfoQuery|\yii\db\ActiveQuery
     */
    public function getHotels($tour_info_id = null, $country_id = null, $city_id = null,
                              $stars_id = null, $appartment_id = null, $hotels_id = null){
        //Получаем отели во всех активных турах
        $query = \common\models\HotelsInfo::find();
        $query->select('hotels_info.*, ti.id as tour_info_id')
            ->leftJoin('tour_info ti', 'ti.hotels_info_id = hotels_info.id 
            and ti.active = 1 and ti.date_end >= '."'".date('Y-m-d')."'");

        $query->andWhere(['hotels_info.active' => 1]);

        if ($appartment_id != null){
            $query->innerJoin('hotels_appartment ha','ha.hotels_info_id = hotels_info.id');
            $query->andWhere(['ha.id'=>$appartment_id]);
        }
        if ($tour_info_id != null){
            $query->andWhere(['ti.id'=>$tour_info_id]);
        }
        if ($country_id != null){
            $query->andWhere(['country'=>$country_id]);
        }
        if ($city_id != null){
            $query->andWhere(['hotels_info.city_id' => $city_id]);
        }

        if ($stars_id != 1 && $stars_id != null) {
            $query->andWhere(['hotels_stars_id' => $stars_id]);
        }
        if ($hotels_id != null){
            $query->andWhere(['hotels_info.id' => $hotels_id]);
        }

        return $query;
    }

}