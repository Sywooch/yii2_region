<?php

namespace frontend\models\bus;

use frontend\models\bus\base\SalOrder as BaseSalOrder;
use Yii;

/**
 * This is the model class for table "sal_order".
 */
class SalOrder extends BaseSalOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
            [
                [['date', 'date_begin', 'date_end', 'date_add', 'date_edit'], 'safe'],
                [['sal_order_status_id', 'user_id', 'tour_info_id'], 'required'],
                [['sal_order_status_id', 'enable', 'hotels_info_id', 'hotels_appartment_id', 'trans_info_id', 'user_id', 'tour_info_id', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['full_price'], 'number'],
                [['insurance_info'], 'string'],
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
            'date' => Yii::t('app', 'Date'),
            'sal_order_status_id' => Yii::t('app', 'Sal Order Status ID'),
            'date_begin' => Yii::t('app', 'Date Begin'),
            'date_end' => Yii::t('app', 'Date End'),
            'enable' => Yii::t('app', 'Enable'),
            'hotels_info_id' => Yii::t('app', 'Hotels Info ID'),
            'hotels_appartment_id' => Yii::t('app', 'Hotels Appartment ID'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'user_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'full_price' => Yii::t('app', 'Full Price'),
            'insurance_info' => Yii::t('app', 'Insurance Info'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
