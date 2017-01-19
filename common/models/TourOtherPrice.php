<?php

namespace common\models;

use common\models\base\TourOtherPrice as BaseTourOtherPrice;

/**
 * This is the model class for table "tour_other_price".
 */
class TourOtherPrice extends BaseTourOtherPrice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['tour_info_id', 'price', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['name'], 'required'],
            [['date_add', 'date_edit'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
