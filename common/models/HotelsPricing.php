<?php

namespace common\models;

use common\models\base\HotelsPricing as BaseHotelsPricing;

/**
 * This is the model class for table "hotels_pricing".
 */
class HotelsPricing extends BaseHotelsPricing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['hotels_appartment_id', 'hotels_info_id', 'hotels_type_of_food_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['name'], 'string'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
