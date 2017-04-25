<?php

namespace common\models;

use common\models\base\KursPercent as BaseKursPercent;
use Yii;

/**
 * This is the model class for table "kurs_percent".
 */
class KursPercent extends BaseKursPercent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['percent'], 'required'],
            [['percent'], 'number'],
            [['date_add', 'date_edit'], 'safe'],
            [['created_by', 'updated_by', 'lock'], 'integer'],
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
            'percent' => Yii::t('app', 'Дробное значение вводить через точку, например: 0.5 или 2.6'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
