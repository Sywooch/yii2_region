<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_info".
 *
 * @property integer $id
 * @property integer $trans_type_id
 * @property string $name
 * @property integer $trans_route_id
 * @property integer $trans_price_id
 *
 * @property SalBasket[] $salBaskets
 * @property Region-travelTransPrice $transPrice
 * @property Region-travelTransRoute $transRoute
 * @property Region-travelTransType $transType
 */
class TransInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trans_type_id', 'name', 'trans_route_id', 'trans_price_id'], 'required'],
            [['trans_type_id', 'trans_route_id', 'trans_price_id'], 'integer'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Схема отвечает за структуру транспортной подсистемы. Учет и хранение рейсов ж/д и авиа транспорта.'),
            'trans_type_id' => Yii::t('app', 'Необходимый тип трансопрт'),
            'name' => Yii::t('app', 'Наименование'),
            'trans_route_id' => Yii::t('app', 'Trans Route ID'),
            'trans_price_id' => Yii::t('app', 'Trans Price ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalBaskets()
    {
        return $this->hasMany(SalBasket::className(), ['trans_info_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransPrice()
    {
        return $this->hasOne(Region-travelTransPrice::className(), ['id' => 'trans_price_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransRoute()
    {
        return $this->hasOne(Region-travelTransRoute::className(), ['id' => 'trans_route_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransType()
    {
        return $this->hasOne(Region-travelTransType::className(), ['id' => 'trans_type_id']);
    }
}
