<?php

namespace common\models\base;

use rico\yii2images\behaviors\ImageBehave;
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
class TourInfo extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $country_id;

    public $country_hotel;
    public $city_hotel;

    public function getAliasModel($plural = false)
    {
        if ($plural) {
            return Yii::t('app', 'TourInfos');
        } else {
            return Yii::t('app', 'TourInfo');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['days', 'active', 'hotels_info_id', 'city_id', /*'tour_composition_id', */
                'created_by', 'updated_by', 'lock'], 'integer'],
            //[['hotels_info_id'], 'required'],
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
            'id' => Yii::t('app', 'Первичный ключ. Сводная информация о туре.'),
            'name' => Yii::t('app', 'Name'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'days' => Yii::t('app', 'Количество дней тура'),
            'active' => Yii::t('app', 'Признак активности тура'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'country_id' => Yii::t('app', 'Страна отправления'),
            'city_id' => Yii::t('app', 'Город отправления'),
            //'tour_composition_id' => Yii::t('app', 'Состав тура'),
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
        return $this->hasOne(\common\models\City::className(), ['id' => 'city_id'])->inverseOf('tourInfos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id'])->inverseOf('tourInfos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getTourComposition()
    {
        return $this->hasOne(\common\models\TourComposition::className(), ['id' => 'tour_composition_id'])->inverseOf('tourInfos');
    }*/

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
    public function getTourOtherPrices()
    {
        return $this->hasMany(\common\models\TourOtherPrice::className(), ['tour_info_id' => 'id'])->inverseOf('tourInfo');
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
            'image' => [
                'class' => ImageBehave::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\TourInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourInfoQuery(get_called_class());
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        $model = $this->getCity();
        if ($model->one() != null) {
            $this->country_id = $model->one()->country_id;
            return \common\models\Country::findOne(['id' => $this->country_id]);
        } else {
            return false;
        }
    }

    /**
     * Получаем данные и разбиваем на категории о туре
     */
    public function categorized()
    {

    }

/*
    public static function getTransportClassName(int $typeId)
    {
        if ($typeId == 1) {
            //Получаем модель автобусов
            return BusInfo::className();
        } elseif ($typeId == 2 or $typeId == 3) {
            //Получаем модель транспорта: поезда или самолеты
            return TransInfo::className();
        }
        return false;
    }
*/
}
