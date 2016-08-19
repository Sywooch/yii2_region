<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "bus_route_point".
 *
 * @property integer $id
 * @property string $name
 * @property string $gps_point_m
 * @property string $gps_point_p
 * @property integer $active
 * @property string $description
 * @property string $date
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \common\models\BusRouteHasBusRoutePoint[] $busRouteHasBusRoutePoints
 * @property \common\models\BusRoute[] $busRoutes
 */
class BusRoutePoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'gps_point_m', 'gps_point_p', 'description'], 'string'],
            [['active', 'created_by', 'updated_by'], 'integer'],
            [['date', 'date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bus_route_point';
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
            'name' => Yii::t('app', 'Название путевой точки'),
            'gps_point_m' => Yii::t('app', 'GPS-координаты меридиана.'),
            'gps_point_p' => Yii::t('app', 'GPS-координаты паралели.'),
            'active' => Yii::t('app', 'Active'),
            'description' => Yii::t('app', 'Описание путевой точки.'),
            'date' => Yii::t('app', 'Дата создания'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRouteHasBusRoutePoints()
    {
        return $this->hasMany(\common\models\BusRouteHasBusRoutePoint::className(), ['bus_route_point_id' => 'id'])->inverseOf('busRoutePoint');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusRoutes()
    {
        return $this->hasMany(\common\models\BusRoute::className(), ['id' => 'bus_route_id'])->viaTable('bus_route_has_bus_route_point', ['bus_route_point_id' => 'id']);
    }

    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
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
     * @return \common\models\BusRoutePointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\BusRoutePointQuery(get_called_class());
    }
}
