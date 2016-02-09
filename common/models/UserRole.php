<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_role".
 *
 * @property integer $id
 * @property string $name_role
 *
 * @property Userinfo[] $userinfos
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name'], 'required'],
            [['role_name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_name' => 'Name Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserinfos()
    {
        return $this->hasMany(Userinfo::className(), ['user_role_id' => 'id']);
    }
}
