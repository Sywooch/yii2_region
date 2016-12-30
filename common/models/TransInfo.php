<?php

namespace common\models;

use common\models\base\TransInfo as BaseTransInfo;

/**
 * This is the model class for table "trans_info".
 */
class TransInfo extends BaseTransInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name', 'trans_type_id', 'trans_route_id'], 'required'],
                [['name'], 'string'],
                [['trans_type_id', 'trans_route_id', 'seats', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
