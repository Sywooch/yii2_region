<?php

namespace common\models;

use common\models\base\TransInfo as BaseTransInfo;
use Yii;

/**
 * This is the model class for table "trans_info".
 */
class TransInfo extends BaseTransInfo
{

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trans_type_id' => Yii::t('app', 'Trans Type ID'),
            'name' => Yii::t('app', 'Name'),
            'trans_route_id' => Yii::t('app', 'Trans Route ID'),
            'seats' => Yii::t('app', 'Seats'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
