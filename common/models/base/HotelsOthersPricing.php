<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "hotels_others_pricing".
 *
 * @property integer $id
 * @property integer $hotels_info_id
 * @property double $price
 * @property integer $type_price
 * @property integer $active
 * @property string $date_begin
 * @property string $date_end
 * @property integer $hotels_others_pricing_type_id
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property \common\models\HotelsOthersPricingType $hotelsOthersPricingType
 */
class HotelsOthersPricing extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_info_id', 'hotels_others_pricing_type_id'], 'required'],
            [['hotels_info_id', 'type_price', 'active', 'hotels_others_pricing_type_id', 'created_by', 'updated_by', 'lock'], 'integer'],
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
        return 'hotels_others_pricing';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'price' => Yii::t('app', 'Price'),
            'type_price' => Yii::t('app', 'Type Price'),
            'active' => Yii::t('app', 'Active'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'hotels_others_pricing_type_id' => Yii::t('app', 'Hotels Others Pricing Type ID'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id'])->inverseOf('hotelsOthersPricings');
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsOthersPricingType()
    {
        return $this->hasOne(\common\models\HotelsOthersPricingType::className(), ['id' => 'hotels_others_pricing_type_id'])->inverseOf('hotelsOthersPricings');
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
     * @return \common\models\HotelsOthersPricingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsOthersPricingQuery(get_called_class());
    }
}
