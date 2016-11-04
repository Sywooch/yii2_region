<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_station".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $gps_parallel
 * @property string $gps_meridian
 * @property integer $address_id
 * @property integer $trans_type_station_id
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransRouteHasTransStation[] $transRouteHasTransStations
 * @property \common\models\TransRoute[] $transRoutes
 * @property \common\models\TransTypeStation $transTypeStation
 */
class TransStation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'trans_type_station_id'], 'required'],
            [['name', 'description', 'gps_parallel', 'gps_meridian'], 'string'],
            [['address_id', 'trans_type_station_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_station';
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
            'description' => Yii::t('app', 'Description'),
            'gps_parallel' => Yii::t('app', 'Gps Parallel'),
            'gps_meridian' => Yii::t('app', 'Gps Meridian'),
            'address_id' => Yii::t('app', 'Address ID'),
            'trans_type_station_id' => Yii::t('app', 'Trans Type Station ID'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRouteHasTransStations()
    {
        return $this->hasMany(\common\models\TransRouteHasTransStation::className(), ['trans_station_id' => 'id'])->inverseOf('transStation');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRoutes()
    {
        return $this->hasMany(\common\models\TransRoute::className(), ['id' => 'trans_route_id'])->viaTable('trans_route_has_trans_station', ['trans_station_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransTypeStation()
    {
        return $this->hasOne(\common\models\TransTypeStation::className(), ['id' => 'trans_type_station_id'])->inverseOf('transStations');
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
     * @return \common\models\TransStationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransStationQuery(get_called_class());
    }
}
