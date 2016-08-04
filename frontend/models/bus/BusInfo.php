<?php

namespace frontend\models\bus;

use Yii;
use \frontend\models\bus\base\BusInfo as BaseBusInfo;

/**
 * This is the model class for table "bus_info".
 */
class BusInfo extends BaseBusInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name'], 'required'],
                [['name'], 'string'],
                [['seat', 'active', 'bus_scheme_seats_id', 'created_by', 'updated_by'], 'integer'],
                [['date', 'date_add', 'date_edit'], 'safe'],
                [['gos_number'], 'string', 'max' => 25],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
