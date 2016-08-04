<?php

namespace frontend\models\bus\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "bus_way".
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
 * @property string $path_time
 *
 * @property \frontend\models\bus\BusReservation[] $busReservations
 * @property \frontend\models\bus\BusInfo $busInfo
 * @property \frontend\models\bus\BusRoute $busPath
 */
class BusWay extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'bus_info_id', 'bus_path_id'], 'required'],
            [['name'], 'string'],
            [['bus_info_id', 'active', 'ended', 'bus_path_id'], 'integer'],
            [['date_create', 'date_begin', 'date_end'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'bus_info_id' => Yii::t('app', 'Bus Info ID'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Active'),
            'ended' => Yii::t('app', 'Ended'),
            'bus_path_id' => Yii::t('app', 'Bus Path ID'),
            'path_time' => Yii::t('app', 'Path Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusReservations()
    {
        return $this->hasMany(\frontend\models\bus\BusReservation::className(), ['bus_way_id' => 'id'])->inverseOf('busWay');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusInfo()
    {
        return $this->hasOne(\frontend\models\bus\BusInfo::className(), ['id' => 'bus_info_id'])->inverseOf('busWays');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusPath()
    {
        return $this->hasOne(\frontend\models\bus\BusRoute::className(), ['id' => 'bus_path_id'])->inverseOf('busWays');
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
     * @return \frontend\models\bus\BusWayQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\bus\BusWayQuery(get_called_class());
    }
}
