<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "hotels_character".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $num_hierar
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
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'date_add',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'date_edit',
                ],
                'value' => function() { return date('Y-m-d H:i:s'); // unix timestamp
                },
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['parent_id', /*'num_hierar',*/], 'integer'],
            ['parent_id','default', 'value'=>0],
            [['date_add','date_edit'], 'safe'],
            [['active'], 'boolean'],
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
            'parent_id' => Yii::t('app', 'Родительская характеристика'),
            //'num_hierar' => Yii::t('app', 'Номер уровеня в иерархии характеристик'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app','Date Edit'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelsCharacterItems()
    {
        return $this->hasMany(HotelsCharacterItem::className(), ['hotels_character_id' => 'id']);
    }

    /**
     *
     */
    public function listAll($active = true) {
        if ($active === true) {
            return $this->findAll(['active' => 1]);
        }
        else{
            return false;
        }

    }
}
