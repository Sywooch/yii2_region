<?php

namespace common\models;

use Yii;

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
     */
    public function rules()
    {
        return [
            [['name', 'discount', 'hotels_info_id'], 'required'],
            [['name'], 'string'],
            [['discount'], 'number'],
            [['type_price', 'active', 'hotels_info_id'], 'integer'],
            [['date_begin', 'date_end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о скидках, действующих в отелях.'),
            'name' => Yii::t('app', 'Название скидки'),
            'discount' => Yii::t('app', 'Стоимость скидки в процентном или денежном выражении (зависит от поля type_price)'),
            'type_price' => Yii::t('app', 'Тип скидки: 0 - фиксированная скидка (цена скидки указывается в поле discount), 1 - процент от стоимости (процент указывается в коле discount)'),
            'date_begin' => Yii::t('app', 'Дата начала действия скидки'),
            'date_end' => Yii::t('app', 'Дата окончания действия скидки'),
            'active' => Yii::t('app', 'Активна ли скидка? По-умолчанию: активна.'),
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
