<?php

namespace common\models;

use common\models\base\BusWay as BaseBusWay;
use Yii;

/**
 * This is the model class for table "bus_way".
 */
class BusWay extends BaseBusWay
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['name', 'bus_info_id', 'bus_route_id'], 'required'],
                [['name'], 'string'],
                [['bus_info_id', 'active', 'ended', 'bus_route_id', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['price'], 'number'],
                [['path_time'], 'string', 'max' => 45],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            //'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'bus_info_id' => Yii::t('app', 'Bus Info ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'bus_route_id' => Yii::t('app', 'Bus Route ID'),
            'path_time' => Yii::t('app', 'Path Time'),
            'price' => Yii::t('app', 'Price'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
            //'stop' => Yii::t('app', 'Stop'),
        ];
    }
}
