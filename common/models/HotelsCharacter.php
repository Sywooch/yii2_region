<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_character".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $num_hierar
 * @property integer $hotels_info_id
 *
 * @property HotelsInfo $hotelsInfo
 * @property HotelsCharacterItem[] $hotelsCharacterItems
 */
class HotelsCharacter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_character';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'hotels_info_id'], 'required'],
            [['name'], 'string'],
            [['parent_id', 'num_hierar', 'hotels_info_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название характеристики'),
            'parent_id' => Yii::t('app', 'Родитель характеристики (из этой же таблицы)'),
            'num_hierar' => Yii::t('app', 'Номер уровеня в иерархии характеристик'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacterItems()
    {
        return $this->hasMany(HotelsCharacterItem::className(), ['hotels_character_id' => 'id']);
    }
}
