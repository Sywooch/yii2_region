<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "tour_composition".
 *
 * @property integer $id
 * @property string $name
 * @property integer $hotel
 * @property integer $transport
 * @property integer $food
 * @property integer $transfer
 * @property integer $insure
 * @property integer $visa
 * @property integer $excursion
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TourInfo[] $tourInfos
 */
class TourComposition extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['hotel', 'transport', 'food', 'transfer', 'insure', 'visa', 'excursion', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_composition';
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
            'name' => Yii::t('app', 'Наименование состава тура'),
            'hotel' => Yii::t('app', 'Проживание'),
            'transport' => Yii::t('app', 'Проезд/перелет'),
            'food' => Yii::t('app', 'Питание'),
            'transfer' => Yii::t('app', 'Трансфер'),
            'insure' => Yii::t('app', 'Страховка'),
            'visa' => Yii::t('app', 'Оформление визы (при необходимости)'),
            'excursion' => Yii::t('app', 'Экскурсии(если необходимо)'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getTourInfos()
    {
        return $this->hasMany(\common\models\TourInfo::className(), ['tour_composition_id' => 'id']);
    }*/

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
     * @return \common\models\TourCompositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourCompositionQuery(get_called_class());
    }
}
