<?php

namespace frontend\models\bus;

/**
 * This is the ActiveQuery class for [[SalOrderHasPerson]].
 *
 * @see SalOrderHasPerson
 */
class SalOrderHasPersonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SalOrderHasPerson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SalOrderHasPerson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}