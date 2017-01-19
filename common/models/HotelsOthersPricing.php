<?php

namespace common\models;

use common\models\base\HotelsOthersPricing as BaseHotelsOthersPricing;

/**
 * This is the model class for table "hotels_others_pricing".
 */
class HotelsOthersPricing extends BaseHotelsOthersPricing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['hotels_info_id', 'hotels_others_pricing_type_id'], 'required'],
            [['hotels_info_id', 'type_price', 'active', 'hotels_others_pricing_type_id', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['price'], 'number'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
