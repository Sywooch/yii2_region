<?php

namespace common\models;

use common\models\base\Voucher as BaseVoucher;

/**
 * This is the model class for table "sal_order".
 */
class Voucher extends BaseVoucher
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
                [['sal_order_status_id', 'enable', 'hotels_info_id', 'hotels_appartment_id', 'trans_info_id', 'hotels_type_of_food_id', 'user_id', 'tour_info_id', 'created_by', 'updated_by', 'lock'], 'integer'],
                [['full_price'], 'number'],
                [['insurance_info'], 'string'],
                [['lock'], 'default', 'value' => '0'],
                [['lock'], 'mootensai\components\OptimisticLockValidator']
            ]);
    }

}
