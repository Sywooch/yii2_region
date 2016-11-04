<?php

namespace common\models;

use common\models\base\TransRoute as BaseTransRoute;
use Yii;

/**
 * This is the model class for table "trans_route".
 */
class TransRoute extends BaseTransRoute
{


    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'begin_point' => Yii::t('app', 'Begin Point'),
            'end_point' => Yii::t('app', 'End Point'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
