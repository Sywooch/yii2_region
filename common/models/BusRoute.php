<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bus_route".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $date_begin
 * @property string $date_end
 *
 * @property BusRouteHasBusRoutePoint[] $busRouteHasBusRoutePoints
 * @property BusRoutePoint[] $busRoutePoints
 * @property BusWay[] $busWays
 */
class BusRoute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['date', 'date_begin', 'date_end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. В таблице хранятся все маршруты, которые могут проходить автобусы.'),
            'name' => Yii::t('app', 'Name'),
            'date' => Yii::t('app', 'Date'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRouteHasBusRoutePoints()
    {
        return $this->hasMany(BusRouteHasBusRoutePoint::className(), ['bus_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutePoints()
    {
        return $this->hasMany(BusRoutePoint::className(), ['id' => 'bus_route_point_id'])->viaTable('bus_route_has_bus_route_point', ['bus_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusWays()
    {
        return $this->hasMany(BusWay::className(), ['bus_path_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BusRouteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusRouteQuery(get_called_class());
    }
}
