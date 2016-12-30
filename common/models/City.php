<?php

namespace common\models;

use common\models\base\City as BaseCity;

/**
 * This is the model class for table "city".
 */
class City extends BaseCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['description'], 'string'],
                [['date_add', 'date_edit'], 'safe'],
                [['active', 'country_id'], 'integer'],
                [['name'], 'string', 'max' => 50],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
