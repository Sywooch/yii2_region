<?php

namespace common\models;

use common\models\base\TourType as BaseTourType;

/**
 * This is the model class for table "tour_type".
 */
class TourType extends BaseTourType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
            [['name', 'days'], 'required'],
            [['name'], 'string'],
                [['days', 'created_by', 'updated_by', 'lock', 'active'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
