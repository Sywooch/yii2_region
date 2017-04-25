<?php

namespace common\models;

use common\models\base\KursCurrency as BaseKursCurrency;
use Yii;

/**
 * This is the model class for table "kurs_currency".
 */
class KursCurrency extends BaseKursCurrency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['kurs_type_currency_id', 'active', 'created_by', 'updated_by'], 'integer'],
            [['date_add', 'date_edit','date'], 'safe'],
            [['okurs', 'skurs', 'percent'], 'number'],
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
            'kurs_type_currency_id' => Yii::t('app', 'Kurs Type Currency ID'),
            'date' => Yii::t('app', 'Date Kurs'),
            'date_add' => Yii::t('app', 'Date Add'),
            'okurs' => Yii::t('app', 'Okurs'),
            'skurs' => Yii::t('app', 'Skurs'),
            'percent' => Yii::t('app', 'Percent'),
            'active' => Yii::t('app', 'Active'),
            'date_edit' => Yii::t('app', 'Date Edit'),
        ];
    }
}
