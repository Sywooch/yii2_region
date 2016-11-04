<?php

namespace common\models;

use common\models\base\TransType as BaseTransType;
use Yii;

/**
 * This is the model class for table "trans_type".
 */
class TransType extends BaseTransType
{


    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'trans_type_station_id' => Yii::t('app', 'Trans Type Station ID'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
