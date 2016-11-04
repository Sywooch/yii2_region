<?php

namespace common\models\base;

use common\models\TransTypeStation;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $trans_type_station_id
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransInfo[] $transInfos
 * @property \common\models\TransTypeStation $transTypeStation
 */
class TransType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'trans_type_station_id'], 'required'],
            [['name'], 'string'],
            [['trans_type_station_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['trans_type_station_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransTypeStation::className(), 'targetAttribute' => ['trans_type_station_id' => 'id']],
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
        return 'trans_type';
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
    public function getTransInfos()
    {
        return $this->hasMany(\common\models\TransInfo::className(), ['trans_type_id' => 'id'])->inverseOf('transType');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransTypeStation()
    {
        return $this->hasOne(\common\models\TransTypeStation::className(), ['id' => 'trans_type_station_id'])->inverseOf('transTypes');
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
     * @return \backend\models\TransTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\TransTypeQuery(get_called_class());
    }
}
