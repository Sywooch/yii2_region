<?php

namespace frontend\models\bus\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "bus_route_has_bus_route_point".
 *
 * @property integer $bus_route_id
 * @property integer $bus_route_point_id
 * @property integer $first_point
 * @property integer $end_point
 * @property integer $position
 * @property string $date_point_forward
 * @property integer $time_pause
 * @property string $date_point_reverse
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \frontend\models\bus\BusRoute $busRoute
 * @property \frontend\models\bus\BusRoutePoint $busRoutePoint
 */
class BusRouteHasBusRoutePoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bus_route_id', 'bus_route_point_id'], 'required'],
            [['bus_route_id', 'bus_route_point_id', 'first_point', 'end_point', 'position', 'time_pause', 'created_by', 'updated_by'], 'integer'],
            [['date_point_forward', 'date_point_reverse', 'date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route_has_bus_route_point';
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
            'bus_route_id' => Yii::t('app', 'Bus Route ID'),
            'bus_route_point_id' => Yii::t('app', 'Bus Route Point ID'),
            'first_point' => Yii::t('app', 'First Point'),
            'end_point' => Yii::t('app', 'End Point'),
            'position' => Yii::t('app', 'Position'),
            'date_point_forward' => Yii::t('app', 'Date Point Forward'),
            'time_pause' => Yii::t('app', 'Time Pause'),
            'date_point_reverse' => Yii::t('app', 'Date Point Reverse'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoute()
    {
        return $this->hasOne(\frontend\models\bus\BusRoute::className(), ['id' => 'bus_route_id'])->inverseOf('busRouteHasBusRoutePoints');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutePoint()
    {
        return $this->hasOne(\frontend\models\bus\BusRoutePoint::className(), ['id' => 'bus_route_point_id'])->inverseOf('busRouteHasBusRoutePoints');
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
     * @return \frontend\models\bus\BusRouteHasBusRoutePointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\bus\BusRouteHasBusRoutePointQuery(get_called_class());
    }
}
