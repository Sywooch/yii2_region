<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_route_has_trans_station".
 *
 * @property integer $trans_route_id
 * @property integer $trans_station_id
 * @property integer $position
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransRoute $transRoute
 * @property \common\models\TransStation $transStation
 */
class TransRouteHasTransStation extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_route_id', 'trans_station_id'], 'required'],
            [['trans_route_id', 'trans_station_id', 'position', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
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
        return 'trans_route_has_trans_station';
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
            'trans_route_id' => Yii::t('app', 'Trans Route ID'),
            'trans_station_id' => Yii::t('app', 'Trans Station ID'),
            'position' => Yii::t('app', 'Position'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRoute()
    {
        return $this->hasOne(\common\models\TransRoute::className(), ['id' => 'trans_route_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransStation()
    {
        return $this->hasOne(\common\models\TransStation::className(), ['id' => 'trans_station_id']);
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
     * @return \common\models\TransRouteHasTransStationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransRouteHasTransStationQuery(get_called_class());
    }
}
