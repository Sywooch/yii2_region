<?php

namespace common\models;

use common\models\base\TransStation as BaseTransStation;
use Yii;

/**
 * This is the model class for table "trans_station".
 */
class TransStation extends BaseTransStation
{


    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'gps_parallel' => Yii::t('app', 'Gps Parallel'),
            'gps_meridian' => Yii::t('app', 'Gps Meridian'),
            'address_id' => Yii::t('app', 'Address ID'),
            //'city'
            'trans_type_station_id' => Yii::t('app', 'Trans Type Station ID'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
