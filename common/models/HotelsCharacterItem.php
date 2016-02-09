<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "hotels_character_item".
 *
 * @property integer $id
 * @property string $value
 * @property string $type
 * @property integer $hotels_character_id
 * @property string $metrics
 *
 * @property HotelsCharacter $hotelsCharacter
 */
class HotelsCharacterItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_character_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'hotels_character_id'], 'required'],
            [['value', 'metrics'], 'string'],
            [['hotels_character_id'], 'integer'],
            [['type'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
            'type' => Yii::t('app', 'Type'),
            'hotels_character_id' => Yii::t('app', 'Hotels Character ID'),
            'metrics' => Yii::t('app', 'Единица измерения, если необходимо'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacter()
    {
        return $this->hasOne(HotelsCharacter::className(), ['id' => 'hotels_character_id']);
    }
}
