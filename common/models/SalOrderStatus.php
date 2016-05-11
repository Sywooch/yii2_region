<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sal_order_status".
 *
 * @property integer $id
 * @property string $name
 * @property string $color
 *
 * @property SalOrder[] $salOrders
 */
class SalOrderStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sal_order_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['color'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Название статуса заказа.'),
            'color' => Yii::t('app', 'Цвет статуса заказа в формате RGB.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalOrders()
    {
        return $this->hasMany(SalOrder::className(), ['sal_order_status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SalOrderStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalOrderStatusQuery(get_called_class());
    }
}
