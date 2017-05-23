<?php

namespace backend\models;

use backend\models\base\BusWayGenerator as BaseBusWayGenerator;

/**
 * This is the model class for table "bus_way".
 */
class BusWayGenerator extends BaseBusWayGenerator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['name', 'bus_info_id', 'bus_route_id'], 'required'],
            [['name'], 'string'],
            [['bus_info_id', 'active', 'ended', 'bus_route_id', 'created_by', 'updated_by', 'lock', 'stop'], 'integer'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['price'], 'number'],
            [['path_time'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
