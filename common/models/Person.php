<?php

namespace common\models;

use common\models\base\Person as BasePerson;
use Yii;

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
                [['date_new', 'date_edit', 'date_add'], 'safe'],
                [['contacts', 'other'], 'string'],
                [['child', 'created_by', 'updated_by', 'lock'], 'integer'],
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
            'child' => Yii::t('app', 'Child'),
            'date_add' => Yii::t('app', 'Date Add'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
