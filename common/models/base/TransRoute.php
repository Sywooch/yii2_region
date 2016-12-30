<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_route".
 *
 * @property integer $id
 * @property string $date_begin
 * @property string $date_end
 * @property string $name
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransInfo[] $transInfos
 * @property \common\models\TransRouteHasTransStation[] $transRouteHasTransStations
 * @property \common\models\TransStation[] $transStations
 */
class TransRoute extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['name'], 'string'],
            [['active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_route';
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
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о маршрутных точках транспорта.'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'name' => Yii::t('app', 'Name'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransInfos()
    {
        return $this->hasMany(\common\models\TransInfo::className(), ['trans_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRouteHasTransStations()
    {
        return $this->hasMany(\common\models\TransRouteHasTransStation::className(), ['trans_route_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransStations()
    {
        return $this->hasMany(\common\models\TransStation::className(), ['id' => 'trans_station_id'])->viaTable('trans_route_has_trans_station', ['trans_route_id' => 'id']);
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
     * @return \common\models\TransRouteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransRouteQuery(get_called_class());
    }
}
