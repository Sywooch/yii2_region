<?php

namespace common\models;

use common\models\base\HotelsAppartmentItem as BaseHotelsAppartmentItem;

/**
 * This is the model class for table "hotels_appartment_item".
 */
class HotelsAppartmentItem extends BaseHotelsAppartmentItem
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
                [['count_beds', 'active', 'lock', 'created_by', 'updated_by'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
