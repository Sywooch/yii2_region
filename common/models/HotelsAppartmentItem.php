<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_appartment_item".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count_beds
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 */
class HotelsAppartmentItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_appartment_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['active'], 'boolean'],
            [['count_beds'], 'integer'],
            [['date_add', 'date_edit'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Первичный ключ. Таблица-справочник, содержит информацию о названиях аппартаментов (номеров) в гостиницах.'),
            'name' => Yii::t('app', 'Название типа номера'),
            'count_beds' => Yii::t('app', 'Количество спальных мест (по-умолчанию)'),
            'active' => Yii::t('app', 'Active'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }
}
