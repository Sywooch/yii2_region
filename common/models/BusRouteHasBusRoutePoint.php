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
    const POINT_DISABLE = 0;


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
            [['bus_route_id', 'bus_route_point_id', 'first_point', 'end_point', 'position'], 'integer'],
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
            'bus_route_id' => Yii::t('app', 'Route'),
            'bus_route_point_id' => Yii::t('app', 'Route point'),
            'first_point' => Yii::t('app', 'First point'),
            'end_point' => Yii::t('app', 'Last point'),
            'position' => Yii::t('app', 'Position point'),
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
