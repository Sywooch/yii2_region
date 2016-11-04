<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "tour_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $days
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 * @property integer $active
 *
 * @property \common\models\TourInfoHasTourType[] $tourInfoHasTourTypes
 * @property \common\models\TourInfo[] $tourInfos
 */
class TourType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'days'], 'required'],
            [['name'], 'string'],
            [['days', 'created_by', 'updated_by', 'lock', 'active'], 'integer'],
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
        return 'tour_type';
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
            'days' => Yii::t('app', 'Days'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfoHasTourTypes()
    {
        return $this->hasMany(\common\models\TourInfoHasTourType::className(), ['tour_type_id' => 'id'])->inverseOf('tourType');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfos()
    {
        return $this->hasMany(\common\models\TourInfo::className(), ['id' => 'tour_info_id'])->viaTable('tour_info_has_tour_type', ['tour_type_id' => 'id']);
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
     * @return \common\models\TourTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourTypeQuery(get_called_class());
    }
}
