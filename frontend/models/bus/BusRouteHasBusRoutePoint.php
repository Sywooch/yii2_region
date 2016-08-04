<?php

namespace frontend\models\bus;

use Yii;
use \frontend\models\bus\base\BusRouteHasBusRoutePoint as BaseBusRouteHasBusRoutePoint;

/**
 * This is the model class for table "bus_route_has_bus_route_point".
 */
class BusRouteHasBusRoutePoint extends BaseBusRouteHasBusRoutePoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['bus_route_id', 'bus_route_point_id'], 'required'],
                [['bus_route_id', 'bus_route_point_id', 'first_point', 'end_point', 'position', 'time_pause', 'created_by', 'updated_by'], 'integer'],
                [['date_point_forward', 'date_point_reverse', 'date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
