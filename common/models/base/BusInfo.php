<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "bus_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $gos_number
 * @property integer $seat
 * @property string $date
 * @property integer $active
 * @property integer $bus_scheme_seats_id
 *
 * @property \common\models\BusDriver[] $busDrivers
 * @property \common\models\BusSchemeSeats $busSchemeSeats
 * @property \common\models\BusPlaceHasBusInfo[] $busPlaceHasBusInfos
 * @property \common\models\BusReservation[] $busReservations
 * @property \common\models\BusWay[] $busWays
 * @property string $aliasModel
 */
abstract class BusInfo extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_info';
    }

    /**
     * Alias name of table for crud viewsLists all Area models.
     * Change the alias name manual if needed later
     * @return string
     */
    public function getAliasModel($plural=false)
    {
        if($plural){
            return Yii::t('app', 'BusInfos');
        }else{
            return Yii::t('app', 'BusInfo');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['seat', 'active', 'bus_scheme_seats_id'], 'integer'],
            [['date'], 'safe'],
            [['gos_number'], 'string', 'max' => 25],
            [['bus_scheme_seats_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusSchemeSeats::className(), 'targetAttribute' => ['bus_scheme_seats_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'gos_number' => Yii::t('app', 'Gos Number'),
            'seat' => Yii::t('app', 'Seat'),
            'date' => Yii::t('app', 'Date'),
            'active' => Yii::t('app', 'Active'),
            'bus_scheme_seats_id' => Yii::t('app', 'Bus Scheme Seats ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(
            parent::attributeHints(),
            [
            'id' => Yii::t('app', 'Первичный ключ. Данная схема содержит информацию об автобусах, их наличии на месте, состоянии, времени в пути, а также планированние поездок на автобусных турах.'),
            'name' => Yii::t('app', 'Name'),
            'gos_number' => Yii::t('app', 'Gos Number'),
            'seat' => Yii::t('app', 'Количество посадочных мест в автобусе'),
            'date' => Yii::t('app', 'Date'),
            'active' => Yii::t('app', 'Active'),
            'bus_scheme_seats_id' => Yii::t('app', 'Bus Scheme Seats Id'),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusDrivers()
    {
        return $this->hasMany(\common\models\BusDriver::className(), ['bus_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusSchemeSeats()
    {
        return $this->hasOne(\common\models\BusSchemeSeats::className(), ['id' => 'bus_scheme_seats_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusPlaceHasBusInfos()
    {
        return $this->hasMany(\common\models\BusPlaceHasBusInfo::className(), ['bus_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\common\models\BusReservation::className(), ['bus_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusWays()
    {
        return $this->hasMany(\common\models\BusWay::className(), ['bus_info_id' => 'id']);
    }

    public function getAllSeats()
    {
        return $this->seat;
    }

    /**
     * @inheritdoc
     * @return \common\models\BusInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BusInfoQuery(get_called_class());
    }




}
