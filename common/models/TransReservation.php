<?php

namespace common\models;

use common\models\base\TransReservation as BaseTransReservation;

/**
 * This is the model class for table "trans_reservation".
 */
class TransReservation extends BaseTransReservation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name', 'trans_price_id'], 'required'],
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['number_seats', 'price', 'person_id', 'status', 'trans_price_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['name'], 'string', 'max' => 45],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
