<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_price_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 *
 * @property TransPrice[] $transPrices
 */
class TransPriceType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_price_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string'],
            [['date_add', 'date_edit'], 'safe'],
            [['active'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица содержит информацию о типах цен (например: плацкарта, купе, бизнес-класс, эконом-класс)'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransPrices()
    {
        return $this->hasMany(TransPrice::className(), ['trans_price_type_id' => 'id']);
    }
}
