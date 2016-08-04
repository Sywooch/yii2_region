<?php

namespace common\models;

use Yii;
use \common\models\base\TourTypeTransport as BaseTourTypeTransport;

/**
 * This is the model class for table "tour_type_transport".
 */
class TourTypeTransport extends BaseTourTypeTransport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
            [['name'], 'string']
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }
}
