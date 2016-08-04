<?php

namespace frontend\models\bus;

use Yii;
use \frontend\models\bus\base\BusWay as BaseBusWay;

/**
 * This is the model class for table "bus_way".
 */
class BusWay extends BaseBusWay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name', 'bus_info_id', 'bus_path_id'], 'required'],
                [['name'], 'string'],
                [['bus_info_id', 'active', 'ended', 'bus_path_id'], 'integer'],
                [['date_create', 'date_begin', 'date_end'], 'safe'],
                [['path_time'], 'string', 'max' => 45],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
