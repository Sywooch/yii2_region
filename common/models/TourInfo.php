<?php

namespace common\models;

use common\models\base\TourInfo as BaseTourInfo;

/**
 * This is the model class for table "tour_info".
 */
class TourInfo extends BaseTourInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name'], 'string'],
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['days', 'active', 'hotels_info_id', 'city_id', /*'tour_composition_id', */
                    'created_by', 'updated_by', 'lock'], 'integer'],
                //[['hotels_info_id'], 'required'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }
	
}
