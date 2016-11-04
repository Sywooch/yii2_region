<?php

namespace common\models;

use common\models\base\TransTypeStation as BaseTransTypeStation;
use Yii;

/**
 * This is the model class for table "trans_type_station".
 */
class TransTypeStation extends BaseTransTypeStation
{


    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
