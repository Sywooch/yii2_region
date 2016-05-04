<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $code2
 * @property string $code3
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'full_name', 'code2'], 'required'],

            [['name'], 'string', 'max' => 100],
            [['full_name'], 'string', 'max' => 150],
            [['code2'], 'string', 'max' => 2],
            [['code3'], 'string', 'max' => 3],

            [['name'], 'unique'],
            [['full_name'], 'unique'],
            [['code2'], 'unique'],
            [['code3'], 'unique'],
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
            'full_name' => Yii::t('app', 'Full Name'),
            'code2' => Yii::t('app', 'Code2'),
            'code3' => Yii::t('app', 'Code3'),
        ];
    }
}
