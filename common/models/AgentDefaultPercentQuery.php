<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[AgentDefaultPercent]].
 *
 * @see AgentDefaultPercent
 */
class AgentDefaultPercentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AgentDefaultPercent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AgentDefaultPercent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}