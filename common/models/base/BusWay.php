<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_way".
 *
 * @property integer $id
 * @property string $name
 * @property integer $bus_info_id
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property integer $ended
 * @property integer $bus_route_id
 * @property string $path_time
 * @property double $price
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 * @property integer $stop
 *
 * @property \common\models\BusReservation[] $busReservations
 * @property \common\models\BusInfo $busInfo
 * @property \common\models\BusRoute $busRoute
 */
class BusWay extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $rangedate1;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bus_info_id', 'bus_route_id'], 'required'],
            [['name'], 'string'],
            [['bus_info_id', 'active', 'ended', 'bus_route_id', 'created_by', 'updated_by', 'lock'/*, 'stop'*/], 'integer'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            /*['date_begin', 'date', 'timestampAttribute' => 'date_begin'],
            ['date_end', 'date', 'timestampAttribute' => 'date_end'],
            ['date_begin','compare','compareAttribute'=>'date_end', 'operator'=>'<','enableClientValidation' => false],
*/          [['price'], 'number'],

            [['path_time'], 'string', 'max' => 45],

            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_way';
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
            //'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'bus_info_id' => Yii::t('app', 'Bus Info ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Active'),
            'ended' => Yii::t('app', 'Ended'),
            'bus_route_id' => Yii::t('app', 'Bus Route ID'),
            'path_time' => Yii::t('app', 'Path Time'),
            'price' => Yii::t('app', 'Price'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
            //'stop' => Yii::t('app', 'Stop'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\common\models\BusReservation::className(), ['bus_way_id' => 'id'])->inverseOf('busWay');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusInfo()
    {
        return $this->hasOne(\common\models\BusInfo::className(), ['id' => 'bus_info_id'])->inverseOf('busWays');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoute()
    {
        return $this->hasOne(\common\models\BusRoute::className(), ['id' => 'bus_route_id'])->inverseOf('busWays');
    }

    /**
     * @inheritdoc
     * @return array mixed
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
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\BusWayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BusWayQuery(get_called_class());
    }



}
