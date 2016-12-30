<?php

namespace common\models;

use common\models\base\TransPrice as BaseTransPrice;

/**
 * This is the model class for table "trans_price".
 */
class TransPrice extends BaseTransPrice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['trans_info_id', 'trans_seats_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['trans_seats_id'], 'required'],
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['price'], 'number'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
