<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bus_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $gos_number
 * @property integer $seat
 * @property string $date
 * @property integer $active
 *
 * @property BusDriver[] $busDrivers
 * @property BusWay[] $busWays
 */
class BusInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'seat', 'active'], 'integer'],
            [['name'], 'string'],
            [['date'], 'safe'],
            [['gos_number'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Данная схема содержит информацию об автобусах, их наличии на месте, состоянии, времени в пути, а также планированние поездок на автобусных турах.'),
            'name' => Yii::t('app', 'Name'),
            'gos_number' => Yii::t('app', 'Gos Number'),
            'seat' => Yii::t('app', 'Количество посадочных мест в автобусе'),
            'date' => Yii::t('app', 'Date'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusDrivers()
    {
        return $this->hasMany(BusDriver::className(), ['bus_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusWays()
    {
        return $this->hasMany(BusWay::className(), ['bus_info_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BusInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusInfoQuery(get_called_class());
    }
}
