<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bus_way".
 *
 * @property integer $id
 * @property string $name
 * @property integer $bus_info_id
 * @property string $date_create
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property integer $ended
 * @property integer $bus_path_id
 *
 * @property BusInfo $busInfo
 * @property BusRoute $busPath
 */
class BusWay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_way';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bus_info_id', 'bus_path_id'], 'required'],
            [['name'], 'string'],
            [['bus_info_id', 'active', 'ended', 'bus_path_id'], 'integer'],
            [['date_create', 'date_begin', 'date_end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Данная таблица содержит информацию о всех маршрутах автобусов.'),
            'name' => Yii::t('app', 'Name'),
            'bus_info_id' => Yii::t('app', 'Bus Info ID'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Поле указывает, опубликовано (активно) ли событие в данный момент.'),
            'ended' => Yii::t('app', 'Поле указывает на завершенное событие'),
            'bus_path_id' => Yii::t('app', 'Bus Path ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusInfo()
    {
        return $this->hasOne(BusInfo::className(), ['id' => 'bus_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusPath()
    {
        return $this->hasOne(BusRoute::className(), ['id' => 'bus_path_id']);
    }

    /**
     * @inheritdoc
     * @return BusWayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusWayQuery(get_called_class());
    }
}
