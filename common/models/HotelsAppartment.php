<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_appartment".
 *
 * @property integer $id
 * @property integer $hotels_info_id
 * @property string $name
 * @property double $price
 * @property integer $type_price
 *
 * @property HotelsInfo $hotelsInfo
 * @property HotelsPricing[] $hotelsPricings
 */
class HotelsAppartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_appartment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_info_id', 'name'], 'required'],
            [['hotels_info_id', 'type_price'], 'integer'],
            [['name'], 'string'],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'type_price' => Yii::t('app', 'Type Price'),
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
    public function getHotelsPricings()
    {
        return $this->hasMany(HotelsPricing::className(), ['hotels_appartment_id' => 'id', 'hotels_appartment_hotels_info_id' => 'hotels_info_id']);
    }
}
