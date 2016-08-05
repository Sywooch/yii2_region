<?php

namespace frontend\models\bus\base;

use mootensai\behaviors\UUIDBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $gos_number
 * @property integer $seat
 * @property string $date
 * @property integer $active
 * @property integer $bus_scheme_seats_id
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \frontend\models\bus\BusDriver[] $busDrivers
 * @property \frontend\models\bus\BusSchemeSeats $busSchemeSeats
 * @property \frontend\models\bus\BusPlaceHasBusInfo[] $busPlaceHasBusInfos
 * @property \frontend\models\bus\BusReservation[] $busReservations
 * @property \frontend\models\bus\BusWay[] $busWays
 */
class BusInfo extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['seat', 'active', 'bus_scheme_seats_id', 'created_by', 'updated_by'], 'integer'],
            [['date', 'date_add', 'date_edit'], 'safe'],
            [['gos_number'], 'string', 'max' => 25],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_info';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock()
    {
        return 'lock';
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
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusDrivers()
    {
        return $this->hasMany(\frontend\models\bus\BusDriver::className(), ['bus_info_id' => 'id'])->inverseOf('busInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusSchemeSeats()
    {
        return $this->hasOne(\frontend\models\bus\BusSchemeSeats::className(), ['id' => 'bus_scheme_seats_id'])->inverseOf('busInfos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusPlaceHasBusInfos()
    {
        return $this->hasMany(\frontend\models\bus\BusPlaceHasBusInfo::className(), ['bus_info_id' => 'id'])->inverseOf('busInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\frontend\models\bus\BusReservation::className(), ['bus_info_id' => 'id'])->inverseOf('busInfo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusWays()
    {
        return $this->hasMany(\frontend\models\bus\BusWay::className(), ['bus_info_id' => 'id'])->inverseOf('busInfo');
    }

    /**
     * @inheritdoc
     * @return type mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_add',
                'updatedAtAttribute' => 'date_edit',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \frontend\models\bus\BusInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\bus\BusInfoQuery(get_called_class());
    }
}
