<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "hotels_character_item".
 *
 * @property integer $id
 * @property string $value
 * @property string $type
 * @property integer $hotels_character_id
 * @property string $metrics
 * @property integer $hotels_info_id
 * @property integer $active
 * @property string $date_add
 * @property string $date_edit
 *
 * @property \common\models\HotelsCharacter $hotelsCharacter
 * @property \common\models\HotelsInfo $hotelsInfo
 * @property string $aliasModel
 */
abstract class HotelsCharacterItem extends \yii\db\ActiveRecord
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
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_add',
                'updatedAtAttribute' => 'date_edit',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'hotels_character_id', 'hotels_info_id'], 'required'],
            [['value', 'metrics'], 'string'],
            [['hotels_character_id', 'hotels_info_id', 'active'], 'integer'],
            [['type'], 'string', 'max' => 45],
            [['hotels_character_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\HotelsCharacter::className(), 'targetAttribute' => ['hotels_character_id' => 'id']],
            [['hotels_info_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\HotelsInfo::className(), 'targetAttribute' => ['hotels_info_id' => 'id']]
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
            'metrics' => Yii::t('app', 'Metrics'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'metrics' => Yii::t('app', 'Единица измерения, если необходимо'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacter()
    {
        return $this->hasOne(\common\models\HotelsCharacter::className(), ['id' => 'hotels_character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsInfo()
    {
        return $this->hasOne(\common\models\HotelsInfo::className(), ['id' => 'hotels_info_id']);
    }


    
    /**
     * @inheritdoc
     * @return HotelsCharacterItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\HotelsCharacterItemQuery(get_called_class());
    }


}
