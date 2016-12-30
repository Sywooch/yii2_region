<?php

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "hotels_pay_period".
 *
 * @property integer $id
 * @property integer $hotels_pricing_id
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property string $price
 * @property string $date_add
 * @property string $date_edit
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $lock
 *
 * @property \common\models\HotelsPricing $hotelsPricing
 */
class HotelsPayPeriod extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_pricing_id'], 'required'],
            [['hotels_pricing_id', 'active', 'created_by', 'updated_by', 'lock'], 'integer'],
            [['date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
            [['price'], 'number'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_pay_period';
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
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о периодах заездов и ценах в эти периоды'),
            'hotels_pricing_id' => Yii::t('app', 'Hotels Pricing ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'active' => Yii::t('app', 'Active'),
            'price' => Yii::t('app', 'Price'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricing()
    {
        return $this->hasOne(\common\models\HotelsPricing::className(), ['id' => 'hotels_pricing_id'])->inverseOf('hotelsPayPeriods');
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
     * @return \common\models\HotelsPayPeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsPayPeriodQuery(get_called_class());
    }
}
