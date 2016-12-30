<?php

namespace common\models;

use common\models\base\TransSeats as BaseTransSeats;

/**
 * This is the model class for table "trans_seats".
 */
class TransSeats extends BaseTransSeats
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['trans_info_id', 'trans_seats_type_id', 'name'], 'required'],
                [['trans_info_id', 'trans_seats_type_id', 'count', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['name'], 'string', 'max' => 255],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
