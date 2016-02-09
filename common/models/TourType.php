<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tour_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $days
 */
class TourType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'days'], 'required'],
            [['name'], 'string'],
            [['days'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Данная таблица-справочник содержит типы туров.'),
            'name' => Yii::t('app', 'Название типа тура (Автобусные туры, Свадебные туры и т.д.)'),
            'days' => Yii::t('app', 'Продолжительность типа тура в днях (шаблонная)'),
        ];
    }
}
