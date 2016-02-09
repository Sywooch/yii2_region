<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_price".
 *
 * @property integer $id
 * @property double $price
 * @property string $date_add
 * @property string $date_edit
 * @property integer $trans_price_type_id
 *
 * @property TransPriceType $transPriceType
 */
class TransPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['date_add', 'date_edit'], 'safe'],
            [['trans_price_type_id'], 'required'],
            [['trans_price_type_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о цене маршрута'),
            'price' => Yii::t('app', 'Price'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'trans_price_type_id' => Yii::t('app', 'Trans Price Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransPriceType()
    {
        return $this->hasOne(TransPriceType::className(), ['id' => 'trans_price_type_id']);
    }
}
