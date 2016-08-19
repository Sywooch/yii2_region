<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "sal_order_has_person".
 *
 * @property integer $sal_order_id
 * @property integer $person_id
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\Person $person
 * @property \common\models\SalOrder $salOrder
 */
class SalOrderHasPerson extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sal_order_id', 'person_id'], 'required'],
            [['sal_order_id', 'person_id', 'created_by', 'updated_by', 'lock'], 'integer'],
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
        return 'sal_order_has_person';
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
            'sal_order_id' => Yii::t('app', 'Sal Order ID'),
            'person_id' => Yii::t('app', 'Person ID'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(\common\models\Person::className(), ['id' => 'person_id'])->inverseOf('salOrderHasPeople');
    }

    public function getGender()
    {
        return $this->hasOne(\common\models\Gender::className(), ['id' => 'gender_id'])->viaTable('person', ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrder()
    {
        return $this->hasOne(\common\models\SalOrder::className(), ['id' => 'sal_order_id'])->inverseOf('salOrderHasPeople');
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
     * @return \common\models\SalOrderHasPersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\SalOrderHasPersonQuery(get_called_class());
    }
}
