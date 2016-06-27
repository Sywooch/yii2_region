<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "hotels_pay_period".
 *
 * @property integer $id
 * @property integer $hotels_pricing_id
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property string $price
 * @property string $date_add
 * @property string $date_edit
 *
 * @property \common\models\HotelsPricing $hotelsPricing
 * @property string $aliasModel
 */
abstract class HotelsPayPeriod extends \yii\db\ActiveRecord
{

    const DEFAULT_ACTIVE = 1;
    const DEFAULT_PRICE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_pay_period';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_add',
                'updatedAtAttribute' => 'date_edit',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotels_pricing_id'], 'required'],
            [['hotels_pricing_id', 'active'], 'integer'],
            [['date_begin', 'date_end'], 'safe'],
            [['price'], 'number'],
            [['hotels_pricing_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\HotelsPricing::className(), 'targetAttribute' => ['hotels_pricing_id' => 'id']]
        ];
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
     * @return HotelsPayPeriodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsPayPeriodQuery(get_called_class());
    }

    public function addOne()
    {
        $this->date_begin = date('DD-MM-YY');
        $this->date_end = date('DD-MM-YY')+1;
        $this->active = self::DEFAULT_ACTIVE;
        $this->price = self::DEFAULT_PRICE;
    }

}
