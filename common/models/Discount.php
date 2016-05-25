<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property string $name
 * @property double $discount
 * @property integer $type_price
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property integer $hotels_info_id
 *
 * @property HotelsInfo $hotelsInfo
 * @property HotelsPricing[] $hotelsPricings
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'discount'], 'required'],
            [['name'], 'string'],
            [['discount'], 'number'],
            [['type_price', 'active'], 'integer'],
            [['date_begin', 'date_end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'name' => Yii::t('app', 'Название скидки'),
            'discount' => Yii::t('app', 'Стоимость скидки'),
            'type_price' => Yii::t('app', 'Скидка в процентах (иначе, в денежном выражении)'),
            'date_begin' => Yii::t('app', 'Начало скидки'),
            'date_end' => Yii::t('app', 'Окончане скидки'),
            'active' => Yii::t('app', 'Активность'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
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
        return $this->hasMany(HotelsPricing::className(), ['discount_id' => 'id']);
    }
}
