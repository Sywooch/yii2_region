<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 * @property integer $country_id
 *
 * @property \common\models\Country $country
 * @property \common\models\HotelsInfo[] $hotelsInfos
 * @property \common\models\TourInfo[] $tourInfos
 */
class City extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['active', 'country_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
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
            'name' => Yii::t('app', 'Название города'),
            'description' => Yii::t('app', 'Описание'),
            'date_add' => Yii::t('app', 'Дата добавления записи'),
            'date_edit' => Yii::t('app', 'Дата последнего редактирования записи'),
            'active' => Yii::t('app', 'Активность'),
            'country_id' => Yii::t('app', 'Country ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(\common\models\Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfos()
    {
        return $this->hasMany(\common\models\HotelsInfo::className(), ['city_id' => 'id'])->inverseOf('city');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfos()
    {
        return $this->hasMany(\common\models\TourInfo::className(), ['city_id' => 'id'])->inverseOf('city');
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
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\CityQuery(get_called_class());
    }
}
