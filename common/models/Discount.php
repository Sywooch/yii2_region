<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property string $name
 * @property double $discount
 * @property integer $type_price
 * @property string $date_begin
 * @property string $date_end
 * @property integer $active
 * @property integer $hotels_info_id
 *
 * @property HotelsInfo $hotelsInfo
 * @property HotelsPricing[] $hotelsPricings
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'discount'], 'required'],
            [['name'], 'string'],
            [['discount'], 'number'],
            [['years', 'active'], 'integer'],
            [['date_add', 'date_edit'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'name' => Yii::t('app', 'Название скидки'),
            'discount' => Yii::t('app', 'Стоимость скидки (%)'),
            'years' => Yii::t('app', 'Предельный возраст'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Активность'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsPricings()
    {
        return $this->hasMany(HotelsPricing::className(), ['discount_id' => 'id']);
    }
}
