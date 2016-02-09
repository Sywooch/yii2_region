<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bus_driver".
 *
 * @property integer $id
 * @property string $FIO
 * @property string $number_license
 * @property integer $active
 * @property string $date
 * @property integer $first
 * @property integer $bus_info_id
 *
 * @property BusInfo $busInfo
 */
class BusDriver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FIO', 'bus_info_id'], 'required'],
            [['FIO', 'number_license'], 'string'],
            [['active', 'first', 'bus_info_id'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о водителях автобусов.'),
            'FIO' => Yii::t('app', 'Фамилия Имя Отчество водителя'),
            'number_license' => Yii::t('app', 'Номер водительского удостоверения.'),
            'active' => Yii::t('app', 'Активирована ли запись.'),
            'date' => Yii::t('app', 'Дата регистрации.'),
            'first' => Yii::t('app', 'Признак основного водителя'),
            'bus_info_id' => Yii::t('app', 'Bus Info ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusInfo()
    {
        return $this->hasOne(BusInfo::className(), ['id' => 'bus_info_id']);
    }
}
