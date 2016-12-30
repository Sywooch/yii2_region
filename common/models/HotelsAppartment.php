<?php

namespace common\models;

use common\models\base\HotelsAppartment as BaseHotelsAppartment;

/**
 * This is the model class for table "hotels_appartment".
 */
class HotelsAppartment extends BaseHotelsAppartment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['hotels_info_id', 'hotels_appartment_item_id'], 'required'],
                [['hotels_info_id', 'hotels_appartment_item_id', 'active', 'count_rooms', 'count_beds', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['name'], 'string'],
                [['price'], 'number'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
