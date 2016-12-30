<?php

namespace common\models;

use common\models\base\TransRoute as BaseTransRoute;

/**
 * This is the model class for table "trans_route".
 */
class TransRoute extends BaseTransRoute
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['name'], 'string'],
                [['active', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
