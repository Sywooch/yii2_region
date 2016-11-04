<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "gender".
 *
 * @property integer $id
 * @property string $name
 * @property string $eng_name
 *
 * @property \common\models\Person[] $people
 * @property string $aliasModel
 */
abstract class Gender extends \yii\db\ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gender';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'eng_name'], 'required'],
            [['name', 'eng_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'eng_name' => Yii::t('app', 'Eng Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(\common\models\Person::className(), ['gender_id' => 'id']);
    }


    /**
     * @inheritdoc
     * @return GenderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\GenderQuery(get_called_class());
    }


}