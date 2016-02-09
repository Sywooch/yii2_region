<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $create_time
 * @property string $last_login
 * @property string $auth_key
 * @property integer $user_role_id
 *
 * @property AccessLimitation[] $accessLimitations
 * @property LoginHistory[] $loginHistories
 * @property LoginStatistic[] $loginStatistics
 * @property UserRole $userRole
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password', 'create_time', 'user_role_id'], 'required'],
            [['create_time', 'last_login'], 'safe'],
            [['user_role_id'], 'integer'],
            [['login'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 200],
            [['password'], 'string', 'max' => 32],
            [['auth_key'], 'string', 'max' => 250],
            [['login'], 'unique'],
            [['password'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'create_time' => 'Create Time',
            'last_login' => 'Last Login',
            'auth_key' => 'Auth Key',
            'user_role_id' => 'User Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessLimitations()
    {
        return $this->hasMany(AccessLimitation::className(), ['userinfo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoginHistories()
    {
        return $this->hasMany(LoginHistory::className(), ['userinfo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoginStatistics()
    {
        return $this->hasMany(LoginStatistic::className(), ['userinfo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRole()
    {
        return $this->hasOne(UserRole::className(), ['id' => 'user_role_id']);
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return Yii::$app->security->generateRandomKey(256);

    }
}
