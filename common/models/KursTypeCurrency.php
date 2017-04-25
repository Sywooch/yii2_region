<?php

namespace common\models;

use common\models\base\KursTypeCurrency as BaseKursTypeCurrency;
use Yii;

/**
 * This is the model class for table "kurs_type_currency".
 */
class KursTypeCurrency extends BaseKursTypeCurrency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ncode', 'created_by', 'updated_by', 'active'], 'integer'],
            [['date_add', 'date_edit'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['tcode'], 'string', 'max' => 10],
            [['ncode'], 'unique'],
            [['tcode'], 'unique'],
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
            'name' => Yii::t('app', 'Name'),
            'ncode' => Yii::t('app', 'Ncode'),
            'tcode' => Yii::t('app', 'Tcode'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
