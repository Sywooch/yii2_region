<?php

namespace common\models\base;

use mootensai\behaviors\UUIDBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "hotels_type_of_food".
 *
 * @property integer $id
 * @property string $name
 * @property string $abbrev
 * @property string $price
 * @property integer $type_price
 *
 * @property \common\models\HotelsAppartmentHasHotelsTypeOfFood[] $hotelsAppartmentHasHotelsTypeOfFoods
 * @property \common\models\HotelsPricing[] $hotelsPricings
 * @property \common\models\SalOrder[] $salOrders
 */
class HotelsTypeOfFood extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'abbrev'], 'required'],
            [['name'], 'string'],
            [['price'], 'number'],
            [['type_price'], 'integer'],
            [['abbrev'], 'string', 'max' => 10],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_type_of_food';
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
            'abbrev' => Yii::t('app', 'Abbrev'),
            'price' => Yii::t('app', 'Price'),
            'type_price' => Yii::t('app', 'Type Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartmentHasHotelsTypeOfFoods()
    {
        return $this->hasMany(\common\models\HotelsAppartmentHasHotelsTypeOfFood::className(), ['hotels_type_of_food_id' => 'id'])->inverseOf('hotelsTypeOfFood');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricings()
    {
        return $this->hasMany(\common\models\HotelsPricing::className(), ['hotels_type_of_food_id' => 'id'])->inverseOf('hotelsTypeOfFood');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(\common\models\SalOrder::className(), ['hotels_type_of_food_id' => 'id'])->inverseOf('hotelsTypeOfFood');
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
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\HotelsTypeOfFoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsTypeOfFoodQuery(get_called_class());
    }
}
