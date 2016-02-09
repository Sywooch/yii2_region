<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_others_pricing_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_add
 * @property string $date_edit
 * @property integer $active
 * @property string $description
 */
class HotelsOthersPricingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_others_pricing_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'id' => Yii::t('app', 'Первичный ключ. Таблица-справочник хранит информацию о дополнительных ценах, применяемых к отелям (трансфер, доп. питание, экскурсии и т.д.).'),
            'name' => Yii::t('app', 'Название дополнительного типа цены'),
            'date_add' => Yii::t('app', 'Дата добавления'),
            'date_edit' => Yii::t('app', 'Дата последнего изменения записи'),
            'active' => Yii::t('app', 'Признак активности записи'),
            'description' => Yii::t('app', 'Описание дополнительного типа цены'),
        ];
    }
}
