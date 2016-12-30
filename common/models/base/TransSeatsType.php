<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "trans_seats_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TransSeats[] $transSeats
 */
class TransSeatsType extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_add', 'date_edit'], 'safe'],
            [['created_by', 'updated_by', 'lock'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_seats_type';
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
            'id' => Yii::t('app', 'Идентификатор'),
            'name' => Yii::t('app', 'Наименование типа'),
            'description' => Yii::t('app', 'Краткое описание типа места в транспорте'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransSeats()
    {
        return $this->hasMany(\common\models\TransSeats::className(), ['trans_seats_type_id' => 'id']);
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
     * @return \common\models\TransSeatsTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TransSeatsTypeQuery(get_called_class());
    }
}
