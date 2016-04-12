<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bus_route_has_bus_route_point".
 *
 * @property integer $bus_route_id
 * @property integer $bus_route_point_id
 * @property integer $first_point
 * @property integer $end_point
 *
 * @property BusRoute $busRoute
 * @property BusRoutePoint $busRoutePoint
 */
class BusRouteHasBusRoutePoint extends \yii\db\ActiveRecord
{

    const POINT_ACTIVE = 1;
    const POINT_DISABLE = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route_has_bus_route_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bus_route_id', 'bus_route_point_id'], 'required'],
            [['bus_route_id', 'bus_route_point_id', 'first_point', 'end_point'], 'integer'],
            [['bus_route_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusRoute::className(), 'targetAttribute' => ['bus_route_id' => 'id']],
            [['bus_route_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusRoutePoint::className(), 'targetAttribute' => ['bus_route_point_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bus_route_id' => Yii::t('app', 'Часть составного первичного ключа. Таблица с отношением многие-ко-многим, объеденяющая название маршрута и путевые точки маршрута.'),
            'bus_route_point_id' => Yii::t('app', 'Часть составного первичного ключа.'),
            'first_point' => Yii::t('app', 'Признак того, что данная точка на маршруте является начальной (значение 1).'),
            'end_point' => Yii::t('app', 'Признак того, что данная точка на маршруте является конечной (значение 1).'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoute()
    {
        return $this->hasOne(BusRoute::className(), ['id' => 'bus_route_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutePoint()
    {
        return $this->hasOne(BusRoutePoint::className(), ['id' => 'bus_route_point_id']);
    }
}
