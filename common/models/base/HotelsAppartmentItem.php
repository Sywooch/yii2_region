<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "hotels_appartment_item".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count_beds
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 * @property integer $lock
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \common\models\HotelsAppartment[] $hotelsAppartments
 */
class HotelsAppartmentItem extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['count_beds', 'active', 'lock', 'created_by', 'updated_by'], 'integer'],
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
        return 'hotels_appartment_item';
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
            'id' => Yii::t('app', 'Первичный ключ. Таблица-справочник, содержит информацию о названиях аппартаментов (номеров) в гостиницах.'),
            'name' => Yii::t('app', 'Название типа номера'),
            'count_beds' => Yii::t('app', 'Количество спальных мест (по-умолчанию)'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsAppartments()
    {
        return $this->hasMany(\common\models\HotelsAppartment::className(), ['hotels_appartment_item_id' => 'id']);
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
     * @return \common\models\HotelsAppartmentItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsAppartmentItemQuery(get_called_class());
    }
}
