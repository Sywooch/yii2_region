<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "hotels_pricing".
 *
 * @property integer $id
 * @property integer $hotels_appartment_id
 * @property integer $hotels_appartment_hotels_info_id
 * @property integer $hotels_type_of_food_id
 * @property string $date
 * @property string $name
 * @property integer $active
 *
 * @property \common\models\HotelsPayPeriod[] $hotelsPayPeriods
 * @property \common\models\HotelsAppartment $hotelsAppartment
 * @property \common\models\HotelsTypeOfFood $hotelsTypeOfFood
 * @property string $aliasModel
 */
abstract class HotelsPricing extends \yii\db\ActiveRecord
{

    public $country;

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
            [['hotels_appartment_id', 'hotels_appartment_hotels_info_id', 'hotels_type_of_food_id', 'active', 'country'], 'integer'],
            [['date', 'hotels_appartment_id', 'hotels_appartment_hotels_info_id', 'active', 'country'], 'required'],
            [['date'], 'safe'],
            [['name'], 'string'],
            [['hotels_appartment_id', 'hotels_appartment_hotels_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelsAppartment::className(), 'targetAttribute' => ['hotels_appartment_id' => 'id', 'hotels_appartment_hotels_info_id' => 'hotels_info_id']],
            [['hotels_type_of_food_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\HotelsTypeOfFood::className(), 'targetAttribute' => ['hotels_type_of_food_id' => 'id']]
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
            'hotels_type_of_food_id' => Yii::t('app', 'Hotels Type Of Food ID'),
            'date' => Yii::t('app', 'Date'),
            'name' => Yii::t('app', 'Name'),
            'active' => Yii::t('app', 'Active'),
            'country' => Yii::t('app', 'Country'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPayPeriods()
    {
        return $this->hasMany(\common\models\HotelsPayPeriod::className(), ['hotels_pricing_id' => 'id'])->inverseOf('hotelsPricing');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartment()
    {
        return $this->hasOne(\common\models\HotelsAppartment::className(), ['id' => 'hotels_appartment_id', 'hotels_info_id' => 'hotels_appartment_hotels_info_id'])->inverseOf('hotelsPricings');
    }

    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_appartment_hotels_info_id'])->inverseOf('hotelsPricings');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        $model = $this->getHotelsInfo();
        if ($model->one() != null) {
            $this->country = $model->one()->country;
            return \common\models\Country::findOne(['id' => $this->country]);
        } else {
            return false;
        }
    }

    public function getHotelsByCountry($idCountry)
    {
        $model = new \common\models\HotelsInfo();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->findAll(['country' => $idCountry,'active'=>1]);
    }

    public function getAppertmentsByHotel($idHotel)
    {
        $model = new \common\models\HotelsAppartment();
        //$model->find()->andFilterWhere(['country'=>$idCountry]);
        return $model->findAll(['hotels_info_id' => $idHotel]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsTypeOfFood()
    {
        return $this->hasOne(\common\models\HotelsTypeOfFood::className(), ['id' => 'hotels_type_of_food_id'])->inverseOf('hotelsPricings');
    }


    /**
     * @inheritdoc
     * @return HotelsPricingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsPricingQuery(get_called_class());
    }

    public function getHotelsPayPeriod(){
        return $this->hasMany(\common\models\HotelsPayPeriod::className(), ['hotels_pricing_id'=>'id']);
    }


}