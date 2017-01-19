<?php

namespace common\models\base;

use common\models\BusWay;
use common\models\TourTypeTransport;
use common\models\TransPrice;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "sal_order".
 *
 * @property integer $id
 * @property string $date
 * @property integer $sal_order_status_id
 * @property string $date_begin
 * @property string $date_end
 * @property integer $enable
 * @property integer $hotels_info_id
 * @property integer $hotels_appartment_id
 * @property integer $hotels_type_of_food_id
 * @property integer $trans_info_id
 * @property integer $trans_way_id
 * @property integer $trans_info_id_reverse
 * @property integer $trans_way_id_reverse
 * @property integer $userinfo_id
 * @property integer $tour_info_id
 * @property double $full_price
 * @property string $insurance_info
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 * @property integer $hotels_appartment_full_sale
 * @property string $hotel_date_begin
 * @property string $hotel_date_end
 *
 * @property \common\models\HotelsAppartment $hotelsAppartment
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\HotelsTypeOfFood $hotelsTypeOfFood
 * @property \common\models\SalOrderStatus $salOrderStatus
 * @property \common\models\TourInfo $tourInfo
 * @property \common\models\TourTypeTransport $transInfo
 * @property \common\models\TourTypeTransport $transInfoReverse
 * @property \common\models\Userinfo $userinfo
 * @property \common\models\SalOrderHasPerson[] $salOrderHasPeople
 * @property \common\models\Person[] $people
 * @property $transWay - в зависимости от $transInfo - может принимать 2 значения
 *  - \common\models\BusWay
 *  - \common\models\TransPrice
 * @property $transWayReverse - в зависимости от $transInfoReverse - может принимать 2 значения
 *  - \common\models\BusWay
 *  - \common\models\TransPrice
 */
class SalOrder extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /*public $trans_route;
    public $trans_rout_reverse;*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'date_begin', 'date_end', 'date_add', 'date_edit', 'hotel_date_begin', 'hotel_date_end'], 'safe'],
            [['sal_order_status_id', 'userinfo_id', 'tour_info_id', 'hotels_type_of_food_id'], 'required'],
            [['sal_order_status_id', 'enable', 'hotels_info_id', 'hotels_appartment_id', 'trans_info_id', 'trans_way_id', 'trans_info_id_reverse', 'trans_way_id_reverse', 'hotels_type_of_food_id', 'userinfo_id', 'tour_info_id', 'created_by', 'updated_by', 'lock', 'hotels_appartment_full_sale'], 'integer'],
            [['full_price'], 'number'],
            [['insurance_info'], 'string'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sal_order';
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
            'date' => Yii::t('app', 'Date'),
            'sal_order_status_id' => Yii::t('app', 'Sal Order Status ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'enable' => Yii::t('app', 'Enable'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'hotels_type_of_food_id' => Yii::t('app', 'Type Of Food ID'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'trans_way_id' => Yii::t('app', 'Trans Way ID'),
            'trans_info_id_reverse' => Yii::t('app', 'Trans Info ID Reverse'),
            'trans_way_id_reverse' => Yii::t('app', 'Trans Way ID Reverse'),
            'userinfo_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'full_price' => Yii::t('app', 'Full Price'),
            'insurance_info' => Yii::t('app', 'Insurance Info'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
            'hotels_appartment_full_sale' => Yii::t('app', 'Hotels Appartment Full Sale'),
            'hotel_date_begin' => Yii::t('app', 'Hotel Date Begin'),
            'hotel_date_end' => Yii::t('app', 'Hotel Date End'),
        ];
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
    public function getHotelsTypeOfFood()
    {
        return $this->hasOne(\common\models\HotelsTypeOfFood::className(), ['id' => 'hotels_type_of_food_id'])->inverseOf('salOrders');
    }

    public function getHotelsStar()
    {
        return $this->hasOne(\common\models\HotelsStars::className(), ['id' => 'hotels_stars_id'])->viaTable('hotels_info', ['id' => 'hotels_info_id']);
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
    public function getTransInfoReverse()
    {
        return $this->hasOne(\common\models\TourTypeTransport::className(), ['id' => 'trans_info_id_reverse'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserinfo()
    {
        return $this->hasOne(\common\models\Userinfo::className(), ['id' => 'userinfo_id'])->inverseOf('salOrders');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrderHasPeople()
    {
        return $this->hasMany(\common\models\SalOrderHasPerson::className(), ['sal_order_id' => 'id'])->inverseOf('salOrder');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(\common\models\Person::className(), ['id' => 'person_id'])->viaTable('sal_order_has_person', ['sal_order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return type mixed
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
     * @return \common\models\SalOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\SalOrderQuery(get_called_class());
    }

    /*public function processFullPrice()
    {

    }*/

    /**
     * Функция получает тип транспорта ДО места отдыха на текущий заказ
     * @return $this|bool
     */
    public function getTransWay(){
        $type = $this->transInfo;
        if ($type->id == TourTypeTransport::TYPE_BUS){
            return [$type->id, $this->hasOne(BusWay::className(),['id'=>$this->trans_way_id])->inverseOf('salOrders')];
        }
        elseif ($type->id == TourTypeTransport::TYPE_TRAIN || $type->id == TourTypeTransport::TYPE_AVIA){
            return [$type->id, $this->hasOne(TransPrice::className(),['id'=>$this->trans_way_id])->inverseOf('salOrders')];
        }
        return false;
    }

    /**
     * Функция получает тип транспорта ОТ места отдыха на текущий заказ
     * @return $this|bool
     */
    public function getTransWayReverse(){
        $type = $this->transInfo;
        if ($type->id == TourTypeTransport::TYPE_BUS){
            return [$type->id, $this->hasOne(BusWay::className(),['id'=>$this->trans_way_id])->inverseOf('salOrders')];
        }
        elseif ($type->id == TourTypeTransport::TYPE_TRAIN || $type->id == TourTypeTransport::TYPE_AVIA){
            return [$type->id, $this->hasOne(TransPrice::className(),['id'=>$this->trans_way_id])->inverseOf('salOrders')];
        }
        return false;
    }
}
