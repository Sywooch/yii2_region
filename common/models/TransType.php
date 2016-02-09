<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trans_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $trans_type_station_id
 *
 * @property TransTypeStation $transTypeStation
 */
class TransType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trans_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'trans_type_station_id'], 'required'],
            [['name'], 'string'],
            [['trans_type_station_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Тип транспорт.'),
            'name' => Yii::t('app', 'Название'),
            'trans_type_station_id' => Yii::t('app', 'Выберите тип вокзала для текущего транспорта.'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransTypeStation()
    {
        return $this->hasOne(TransTypeStation::className(), ['id' => 'trans_type_station_id']);
    }
}
