<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_type_transport".
 *
 * @property integer $id
 * @property string $name
 */
class TourTypeTransport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_type_transport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Исходный, неизменяемый справочник с типами транспорта: Собственный транспорт, Автобус, Поезд, Самолет.'),
            'name' => Yii::t('app', 'Наименование типа тура. Справочник.'),
        ];
    }
}
