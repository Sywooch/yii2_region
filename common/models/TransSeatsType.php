<?php

namespace common\models;

use common\models\base\TransSeatsType as BaseTransSeatsType;

/**
 * This is the model class for table "trans_seats_type".
 */
class TransSeatsType extends BaseTransSeatsType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name'], 'required'],
                [['date_add', 'date_edit'], 'safe'],
                [['created_by', 'updated_by', 'lock'], 'integer'],
                [['name'], 'string', 'max' => 100],
                [['description'], 'string', 'max' => 255],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
