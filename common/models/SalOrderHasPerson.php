<?php

namespace common\models;

use common\models\base\SalOrderHasPerson as BaseSalOrderHasPerson;
use Yii;

/**
 * This is the model class for table "sal_order_has_person".
 */
class SalOrderHasPerson extends BaseSalOrderHasPerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['sal_order_id', 'person_id'], 'required'],
                [['sal_order_id', 'person_id', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['date_add', 'date_edit'], 'safe'],
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
            'sal_order_id' => Yii::t('app', 'Sal Order ID'),
            'person_id' => Yii::t('app', 'Person ID'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
