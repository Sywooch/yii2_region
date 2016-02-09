<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_info".
 *
 * @property integer $id
 * @property string $name
 * @property integer $address_id
 * @property integer $country
 * @property string $GPS
 * @property string $links_maps
 * @property integer $hotels_stars_id
 *
 * @property Discount[] $discounts
 * @property HotelsAppartment[] $hotelsAppartments
 * @property HotelsCharacter[] $hotelsCharacters
 * @property HotelsStars $hotelsStars
 * @property HotelsOthersPricing[] $hotelsOthersPricings
 * @property SalBasket[] $salBaskets
 */
class HotelsInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address_id'], 'required'],
            [['name', 'GPS', 'links_maps'], 'string'],
            [['address_id', 'country', 'hotels_stars_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address_id' => Yii::t('app', 'Address ID'),
            'country' => Yii::t('app', 'Country'),
            'GPS' => Yii::t('app', 'Gps'),
            'links_maps' => Yii::t('app', 'Links Maps'),
            'hotels_stars_id' => Yii::t('app', 'Hotels Stars ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discount::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartments()
    {
        return $this->hasMany(HotelsAppartment::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacters()
    {
        return $this->hasMany(HotelsCharacter::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsStars()
    {
        return $this->hasOne(HotelsStars::className(), ['id' => 'hotels_stars_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsOthersPricings()
    {
        return $this->hasMany(HotelsOthersPricing::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalBaskets()
    {
        return $this->hasMany(SalBasket::className(), ['hotels_info_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return HotelsInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotelsInfoQuery(get_called_class());
    }
}
