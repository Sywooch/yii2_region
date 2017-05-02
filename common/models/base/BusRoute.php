<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_route".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $date_begin
 * @property string $date_end
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \common\models\BusRouteHasBusRoutePoint[] $busRouteHasBusRoutePoints
 * @property \common\models\BusRouteHasBusRoutePoint[] $brToBrpTimes
 * @property \common\models\BusRoutePoint[] $busRoutePoints
 * @property \common\models\BusWay[] $busWays
 */
class BusRoute extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $bReverse;
    public $rangedate1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['date', 'date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route';
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
            'date' => Yii::t('app', 'Date'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRouteHasBusRoutePoints()
    {
        return $this->hasMany(\common\models\BusRouteHasBusRoutePoint::className(), ['bus_route_id' => 'id'])->inverseOf('busRoute')->orderBy('position');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrToBrpTimes()
    {
        return $this->hasMany(\common\models\BusRouteHasBusRoutePoint::className(), ['bus_route_id' => 'id'])->inverseOf('busRoute')->orderBy('position');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutePoints()
    {
        return $this->hasMany(\common\models\BusRoutePoint::className(), ['id' => 'bus_route_point_id'])->viaTable('bus_route_has_bus_route_point', ['bus_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusWays()
    {
        return $this->hasMany(\common\models\BusWay::className(), ['bus_route_id' => 'id'])->inverseOf('busRoute');
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
            /*'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],*/
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\BusRouteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BusRouteQuery(get_called_class());
    }
}
