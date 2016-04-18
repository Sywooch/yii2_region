<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_others_pricing".
 *
 * @property integer $id
 * @property integer $hotels_info_id
 * @property double $price
 * @property integer $type_price
 * @property integer $active
 * @property string $date_begin
 * @property string $date_end
 * @property integer $hotels_others_pricing_type_id
 *
 * @property HotelsInfo $hotelsInfo
 * @property Region-travelHotelsOthersPricingType $hotelsOthersPricingType
 * @property HotelsPricing[] $hotelsPricings
 */
class HotelsOthersPricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_others_pricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_info_id', 'hotels_others_pricing_type_id'], 'required'],
            [['hotels_info_id', 'type_price', 'active', 'hotels_others_pricing_type_id'], 'integer'],
            [['price'], 'number'],
            [['date_begin', 'date_end'], 'safe'],
            [['active'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Дополнительные услуги, от которых зависит цена проживания в гостинице. А также сезонные скидки и надбавки.'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'price' => Yii::t('app', 'Ценовая или процентная надбавка к цене.'),
            'type_price' => Yii::t('app', 'Тип цены: 0 - фиксированная цена в денежном выражении(значение по-умолчанию, цена указывается в поле price), 1 - процент от стоимости (процент указывается в поле price)'),
            'active' => Yii::t('app', 'Active'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'hotels_others_pricing_type_id' => Yii::t('app', 'Hotels Others Pricing Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsOthersPricingType()
    {
        return $this->hasOne(HotelsOthersPricingType::className(), ['id' => 'hotels_others_pricing_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricings()
    {
        return $this->hasMany(HotelsPricing::className(), ['hotels_others_pricing_id' => 'id']);
    }
}
