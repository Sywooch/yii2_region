<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[AgentPercent]].
 *
 * @see AgentPercent
 */
class AgentPercentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AgentPercent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AgentPercent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}