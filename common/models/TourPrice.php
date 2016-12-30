<?php

namespace common\models;

use common\models\base\TourPrice as BaseTourPrice;

/**
 * This is the model class for table "tour_price".
 */
class TourPrice extends BaseTourPrice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['tour_info_id', 'tour_composition_id', 'price'], 'required'],
                [['tour_info_id', 'tour_composition_id', 'active', 'in_hotels', 'in_trans', 'in_food', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['price'], 'number'],
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
