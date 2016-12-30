<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "tour_price".
 *
 * @property integer $id
 * @property integer $tour_info_id
 * @property integer $tour_composition_id
 * @property string $price
 * @property integer $active
 * @property string $date_begin
 * @property string $date_end
 * @property integer $in_hotels
 * @property integer $in_trans
 * @property integer $in_food
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\TourInfo $tourInfo
 */
class TourPrice extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_info_id', 'tour_composition_id', 'price'], 'required'],
            [['tour_info_id', 'tour_composition_id', 'active', 'in_hotels', 'in_trans', 'in_food', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['price'], 'number'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_price';
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
            'id' => Yii::t('app', 'Идентификатор
'),
            'tour_info_id' => Yii::t('app', 'Тур'),
            'tour_composition_id' => Yii::t('app', 'Состав тура'),
            'price' => Yii::t('app', 'Цена услуги/товара'),
            'active' => Yii::t('app', 'Активность записи'),
            'date_begin' => Yii::t('app', 'Поле показывает, в какое время цена начинает действовать'),
            'date_end' => Yii::t('app', 'Поле показывает, в какое время цена перестанет действовать'),
            'in_hotels' => Yii::t('app', 'В цену включено проживание'),
            'in_trans' => Yii::t('app', 'В цену включен проезд'),
            'in_food' => Yii::t('app', 'В цену включено питание'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourInfo()
    {
        return $this->hasOne(\common\models\TourInfo::className(), ['id' => 'tour_info_id']);
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
     * @return \common\models\TourPriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\TourPriceQuery(get_called_class());
    }
}
