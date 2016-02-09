<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_type_station".
 *
 * @property integer $id
 * @property string $name
 *
 * @property TransType[] $transTypes
 */
class TransTypeStation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_type_station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Тип вокзала'),
            'name' => Yii::t('app', 'Название'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransTypes()
    {
        return $this->hasMany(TransType::className(), ['trans_type_station_id' => 'id']);
    }
}
