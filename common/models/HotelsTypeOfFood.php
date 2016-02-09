<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_type_of_food".
 *
 * @property integer $id
 * @property string $name
 * @property string $abbrev
 * @property string $price
 * @property integer $type_price
 *
 * @property HotelsAppartmentHasHotelsTypeOfFood[] $hotelsAppartmentHasHotelsTypeOfFoods
 * @property HotelsPricing[] $hotelsPricings
 */
class HotelsTypeOfFood extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_type_of_food';
    }

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
            [['abbrev'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица-справочник содержит тип питания в отеле.'),
            'name' => Yii::t('app', 'Name'),
            'abbrev' => Yii::t('app', 'Abbrev'),
            'price' => Yii::t('app', 'Цена или надбавка к стоимости проживания в гостинице'),
            'type_price' => Yii::t('app', 'Тип цены к проживанию в гостинице. Либо добавляется цена, либо прибавляется процент от исходной суммы номера.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartmentHasHotelsTypeOfFoods()
    {
        return $this->hasMany(HotelsAppartmentHasHotelsTypeOfFood::className(), ['hotels_type_of_food_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricings()
    {
        return $this->hasMany(HotelsPricing::className(), ['hotels_type_of_food_id' => 'id']);
    }
}
