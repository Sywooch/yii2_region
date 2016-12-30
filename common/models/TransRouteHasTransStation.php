<?php

namespace common\models;

use common\models\base\TransRouteHasTransStation as BaseTransRouteHasTransStation;

/**
 * This is the model class for table "trans_route_has_trans_station".
 */
class TransRouteHasTransStation extends BaseTransRouteHasTransStation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['trans_route_id', 'trans_station_id'], 'required'],
                [['trans_route_id', 'trans_station_id', 'position', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
