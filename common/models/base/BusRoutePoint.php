<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_route_point".
 *
 * @property integer $id
 * @property string $name
 * @property string $gps_point_m
 * @property string $gps_point_p
 * @property integer $city_id
 * @property integer $active
 * @property string $description
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\BusRouteHasBusRoutePoint[] $busRouteHasBusRoutePoints
 * @property \common\models\BusRoute[] $busRoutes
 * @property \common\models\City $city
 */
class BusRoutePoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'gps_point_m', 'gps_point_p', 'description'], 'string'],
            [['city_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route_point';
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
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит путевые точки маршрута.'),
            'name' => Yii::t('app', 'Название путевой точки'),
            'gps_point_m' => Yii::t('app', 'GPS-координаты меридиана.'),
            'gps_point_p' => Yii::t('app', 'GPS-координаты паралели.'),
            'city_id' => Yii::t('app', 'City ID'),
            'active' => Yii::t('app', 'Флаг, указывающий активно ли в данный момент путевая точка.'),
            'description' => Yii::t('app', 'Описание путевой точки.'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRouteHasBusRoutePoints()
    {
        return $this->hasMany(\common\models\BusRouteHasBusRoutePoint::className(), ['bus_route_point_id' => 'id'])->inverseOf('busRoutePoint');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutes()
    {
        return $this->hasMany(\common\models\BusRoute::className(), ['id' => 'bus_route_id'])->viaTable('bus_route_has_bus_route_point', ['bus_route_point_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\common\models\City::className(), ['id' => 'city_id'])->inverseOf('busRoutePoints');
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
     * @return \common\models\BusRoutePointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BusRoutePointQuery(get_called_class());
    }
}
