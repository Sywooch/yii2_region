<?php

namespace common\models;

use Yii;
use \common\models\base\Person as BasePerson;

/**
 * This is the model class for table "person".
 */
class Person extends BasePerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['firstname', 'lastname', 'secondname'], 'required'],
                [['date_new', 'date_edit'], 'safe'],
                [['contacts', 'other'], 'string'],
                [['firstname', 'lastname', 'secondname'], 'string', 'max' => 100],
                [['passport_ser'], 'string', 'max' => 10],
                [['passport_num'], 'string', 'max' => 15],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'secondname' => Yii::t('app', 'Secondname'),
            'date_new' => Yii::t('app', 'Date New'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'passport_ser' => Yii::t('app', 'Passport Ser'),
            'passport_num' => Yii::t('app', 'Passport Num'),
            'contacts' => Yii::t('app', 'Contacts'),
            'other' => Yii::t('app', 'Other'),
        ];
    }
}
