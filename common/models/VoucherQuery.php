<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Voucher]].
 *
 * @see Voucher
 */
class VoucherQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Voucher[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Voucher|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}