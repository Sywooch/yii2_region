<?php

namespace common\models;

use common\models\base\TourComposition as BaseTourComposition;

/**
 * This is the model class for table "tour_composition".
 */
class TourComposition extends BaseTourComposition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name'], 'required'],
                [['hotel', 'transport', 'food', 'transfer', 'insure', 'visa', 'excursion', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
                [['name'], 'string', 'max' => 100],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
}
