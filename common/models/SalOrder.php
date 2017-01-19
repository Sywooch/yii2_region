<?php

namespace common\models;

use common\models\base\SalOrder as BaseSalOrder;
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
                [['date', 'date_begin', 'date_end', 'date_add', 'date_edit','hotel_date_begin', 'hotel_date_end'], 'safe'],
                [['sal_order_status_id', 'userinfo_id', 'tour_info_id', 'hotels_type_of_food_id'], 'required'],
                [['sal_order_status_id', 'enable', 'hotels_info_id', 'hotels_appartment_id',
                    'trans_info_id',
                    'trans_way_id',
                    'trans_info_id_reverse',
                    'trans_way_id_reverse',
                    'userinfo_id', 'tour_info_id',
                    'created_by', 'updated_by', 'lock', 'hotels_type_of_food_id'], 'integer'],
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
            'hotels_type_of_food_id' => Yii::t('app', 'Type Of Food Id'),
            'trans_info_id' => Yii::t('app', 'Trans Info ID'),
            'trans_way_id' => Yii::t('app', 'Trans Way ID'),
            'trans_info_id_reverse' => Yii::t('app', 'Trans Info ID Reverse'),
            'trans_way_id_reverse' => Yii::t('app', 'Trans Way ID Reverse'),
            'userinfo_id' => Yii::t('app', 'Userinfo ID'),
            'tour_info_id' => Yii::t('app', 'Tour Info ID'),
            'full_price' => Yii::t('app', 'Full Price'),
            'insurance_info' => Yii::t('app', 'Insurance Info'),
            'date_add' => Yii::t('app', 'Date Add'),
            'date_edit' => Yii::t('app', 'Date Edit'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }
}
