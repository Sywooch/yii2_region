<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_pricing".
 *
 * @property integer $id
 * @property integer $hotels_appartment_id
 * @property integer $hotels_appartment_hotels_info_id
 * @property integer $hotels_others_pricing_id
 * @property string $date
 * @property double $full_price
 * @property integer $discount_id
 * @property string $name
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property integer $hotels_type_of_food_id
 *
 * @property Discount $discount
 * @property HotelsAppartment $hotelsAppartment
 * @property HotelsOthersPricing $hotelsOthersPricing
 * @property HotelsTypeOfFood $hotelsTypeOfFood
 */
class HotelsPricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_pricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_appartment_id', 'hotels_appartment_hotels_info_id', 'hotels_others_pricing_id', 'date', 'discount_id', 'hotels_type_of_food_id'], 'required'],
            [['hotels_appartment_id', 'hotels_appartment_hotels_info_id', 'hotels_others_pricing_id', 'discount_id', 'active', 'hotels_type_of_food_id'], 'integer'],
            [['date', 'date_begin', 'date_end'], 'safe'],
            [['full_price'], 'number'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'hotels_appartment_hotels_info_id' => Yii::t('app', 'Hotels Appartment Hotels Info ID'),
            'hotels_others_pricing_id' => Yii::t('app', 'Hotels Others Pricing ID'),
            'date' => Yii::t('app', 'Date'),
            'full_price' => Yii::t('app', 'Full Price'),
            'discount_id' => Yii::t('app', 'Discount ID'),
            'name' => Yii::t('app', 'Name'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Active'),
            'hotels_type_of_food_id' => Yii::t('app', 'Hotels Type Of Food ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartment()
    {
        return $this->hasOne(HotelsAppartment::className(), ['id' => 'hotels_appartment_id', 'hotels_info_id' => 'hotels_appartment_hotels_info_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(HotelsInfo::className(), ['id' => 'hotels_appartment_hotels_info_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsOthersPricing()
    {
        return $this->hasOne(HotelsOthersPricing::className(), ['id' => 'hotels_others_pricing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsTypeOfFood()
    {
        return $this->hasOne(HotelsTypeOfFood::className(), ['id' => 'hotels_type_of_food_id']);
    }
}
