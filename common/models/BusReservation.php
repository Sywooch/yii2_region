<?php

namespace common\models;

use common\models\base\BusReservation as BaseBusReservation;

/**
 * This is the model class for table "bus_reservation".
 */
class BusReservation extends BaseBusReservation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['bus_info_id', 'bus_way_id'], 'required'],
                [['bus_info_id', 'bus_way_id', 'person_id', 'number_seat', 'status', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date', 'date_add', 'date_edit'], 'safe'],
                [['name'], 'string', 'max' => 45],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
