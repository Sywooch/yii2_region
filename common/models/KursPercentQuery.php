<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[KursPercent]].
 *
 * @see KursPercent
 */
class KursPercentQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return KursPercent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return KursPercent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}