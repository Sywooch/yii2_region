<?php

namespace common\models\base;

use common\models\BusWay;
use common\models\HotelsAppartment;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "tour_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_begin
 * @property string $date_end
 * @property integer $days
 * @property integer $active
 * @property integer $hotels_info_id
 * @property integer $city_id
 * @property integer $tour_composition_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 * @property string $date_add
 * @property string $date_edit
 *
 * @property \common\models\SalBasket[] $salBaskets
 * @property \common\models\SalOrder[] $salOrders
 * @property \common\models\City $city
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\TourComposition $tourComposition
 * @property \common\models\TourInfoHasTourType[] $tourInfoHasTourTypes
 * @property \common\models\TourType[] $tourTypes
 * @property \common\models\TourInfoHasTourTypeTransport[] $tourInfoHasTourTypeTransports
 * @property \common\models\TourTypeTransport[] $tourTypeTransports
 * @property \common\models\TourPrice[] $tourPrices
 */
class TourCalc extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    //Выбираем тип транспорта, на котором будет допираться турист - автобус или поезд/самолет
    const TRANSPORT_TYPE_BUS = 'BUS';
    const TRANSPORT_TYPE_OTHER = 'OTHER';

    protected $appartmentId; // Номер
    protected $typeOfFood; //Тип питания
    protected $date_begin;
    protected $date_end;
    protected $children;
    protected $typeTransport;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['days', 'active', 'hotels_info_id', 'city_id', 'tour_composition_id', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['hotels_info_id'], 'required'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_info';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock()
    {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'days' => Yii::t('app', 'Days'),
            'active' => Yii::t('app', 'Active'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'tour_composition_id' => Yii::t('app', 'Tour Composition ID'),
            'lock' => Yii::t('app', 'Lock'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalBaskets()
    {
        return $this->hasMany(\common\models\SalBasket::className(), ['tour_info_id' => 'id'])->inverseOf('tourInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\common\models\SalOrder::className(), ['tour_info_id' => 'id'])->inverseOf('tourInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\common\models\City::className(), ['id' => 'city_id'])->inverseOf('tourCalcs');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id'])->inverseOf('tourCalcs');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourComposition()
    {
        return $this->hasOne(\common\models\TourComposition::className(), ['id' => 'tour_composition_id'])->inverseOf('tourCalcs');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfoHasTourTypes()
    {
        return $this->hasMany(\common\models\TourInfoHasTourType::className(), ['tour_info_id' => 'id'])->inverseOf('tourInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourTypes()
    {
        return $this->hasMany(\common\models\TourType::className(), ['id' => 'tour_type_id'])->viaTable('tour_info_has_tour_type', ['tour_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfoHasTourTypeTransports()
    {
        return $this->hasMany(\common\models\TourInfoHasTourTypeTransport::className(), ['tour_info_id' => 'id'])->inverseOf('tourInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourTypeTransports()
    {
        return $this->hasMany(\common\models\TourTypeTransport::className(), ['id' => 'tour_type_transport_id'])->viaTable('tour_info_has_tour_type_transport', ['tour_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourPrices()
    {
        return $this->hasMany(\common\models\TourPrice::className(), ['tour_info_id' => 'id'])->inverseOf('tourInfo');
    }

    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_add',
                'updatedAtAttribute' => 'date_edit',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\TourCalcQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourCalcQuery(get_called_class());
    }

    /**
     * Функция расчитывает окончательную цену для тура
     *
     * @return int
     */
    public function priceCalc($countDay = null)
    {

        /**
         * TODO Продумать расчет на несколько периодов, будет ли храниться, либо расчитываться каждый запрос
         * TODO Продумать, откуда брать данные - передавать в функцию или наполнять $this
         */

        $appartmentId = $this->appartmentId;

        $pAppartment = $this->calcPriceAppartment($countDay);
        $pFood = 0; //Входит в цену прожиивания (pApartment)

        $pTransport = $this->calcPriceTransport();
        $pTransfer = $this->calcPriceTransfer();
        $pDiscountHotels = $this->calcDiscountHotels();
        $pDiscountTransport = $this->calcDiscountTransport();
        $pExcursion = $this->calcPriceExtended();


        $finalPrice = $pAppartment
            + $pTransport
            + $pTransfer
            + $pExcursion
            - $pDiscountHotels
            - $pDiscountTransport;

        return $finalPrice;
    }

    /**
     * Функция возвращает цену на данную дату начала тура
     *
     * @param $appartmentId
     * @param $typeOfFood
     * @param $dateSale
     * @param null $countDay
     * @return bool|float
     */

    public function calcPriceAppartment($countDay = null)
    {
        $query = HotelsAppartment::find();
        $appartmentId = $this->appartmentId;
        $typeOfFood = $this->typeOfFood;
        $dateSale = $this->date_begin;
        //Проверяем, передали ли нам количество дней тура, если нет, берем из туров (TourInfo)
        if (!is_integer($countDay)) {
            $countDay = intval($this->getDayTour());
        }

        //Получаем одну единственную цену, по переданным параметрам
        $query->select('hpp.price')
            ->innerJoin('hotels_pay_period hpp', 'hpp.hotels_pricing_id = hotels_pricing.id')
            ->andWhere([
                'hotels_appartment_id' => $appartmentId,
                'hotels_type_of_food_id' => $typeOfFood,
            ])
            ->andWhere("(`hpp`.`date_begin` >= \"$dateSale\") AND (`hpp`.`date_end` <= \"$dateSale\")
            ");
        $result = $query->asArray()->one();
        unset($appartmentId, $typeOfFood, $dateSale);

        if ($result) {
            return floatval($result[0]['price']) * $countDay;
        }
        return false;
    }

    public function getDayTour()
    {
        return $this->days;
    }

    public function calcPriceTransport($id = null)
    {

    }

    private function calcPriceBus($id = null)
    {
        if (isset($id)) {
            $query = BusWay::find()->andWhere(['id' => $id]);
        } else {
            $query = BusWay::find();
            $query->andWhere(['bus_route_id' => $this->routeId])
                ->andWhere(['bus_info_id' => $this->transId])
                ->andWhere(['>='], 'date_begin', $this->transDateBegin);
            /**
             * TODO Добавить проверку на дату заезда
             */
        }
        $result = $query->asArray()->one();
        if ($result) {
            return floatval($result[0]['price']);
        }
    }

    public function calcPriceTransfer()
    {

    }

    public function calcDiscountHotels()
    {

    }

    public function calcDiscountTransport()
    {

    }

    public function calcPriceExtended()
    {

    }

    public function calcFullDays()
    {

    }

    public function countAppartment($appartmentId, $date)
    {
        $query = HotelsAppartment::find($appartmentId)
            ->active()
            ->andWhere([
                    ['>=', 'date_begin', $date],
                    ['>=', 'date_end', $date],
                ]
            );
        return $query->count();
    }

}
