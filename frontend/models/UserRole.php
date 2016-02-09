<?php

namespace app\models;

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
        return 'user_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_role'], 'required'],
            [['name_role'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_role' => 'Name Role',
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
