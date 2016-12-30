<?php

namespace common\models;

use common\models\base\BusRoutePoint as BaseBusRoutePoint;

/**
 * This is the model class for table "bus_route_point".
 */
class BusRoutePoint extends BaseBusRoutePoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
            [['name'], 'required'],
            [['name', 'gps_point_m', 'gps_point_p', 'description'], 'string'],
                [['city_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
