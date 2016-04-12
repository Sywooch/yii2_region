<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bus_route_point".
 *
 * @property integer $id
 * @property string $name
 * @property string $gps_point_m
 * @property string $gps_point_p
 * @property integer $active
 * @property string $description
 * @property string $date
 *
 * @property BusRouteHasBusRoutePoint[] $busRouteHasBusRoutePoints
 * @property BusRoute[] $busRoutes
 */
class BusRoutePoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'gps_point_m', 'gps_point_p', 'description'], 'string'],
            [['active'], 'integer'],
            [['date'], 'safe'],
        ];
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
            'active' => Yii::t('app', 'Флаг, указывающий активно ли в данный момент путевая точка.'),
            'description' => Yii::t('app', 'Описание путевой точки.'),
            'date' => Yii::t('app', 'Дата создания'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRouteHasBusRoutePoints()
    {
        return $this->hasMany(BusRouteHasBusRoutePoint::className(), ['bus_route_point_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutes()
    {
        return $this->hasMany(BusRoute::className(), ['id' => 'bus_route_id'])->viaTable('bus_route_has_bus_route_point', ['bus_route_point_id' => 'id']);
    }

    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

}
