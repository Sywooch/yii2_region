<?php

namespace common\models;

use common\models\base\HotelsPayPeriod as BaseHotelsPayPeriod;

/**
 * This is the model class for table "hotels_pay_period".
 */
class HotelsPayPeriod extends BaseHotelsPayPeriod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['hotels_pricing_id'], 'required'],
                [['hotels_pricing_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['price'], 'number'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
