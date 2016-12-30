<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransInfo]].
 *
 * @see TransInfo
 */
class TransInfoQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}