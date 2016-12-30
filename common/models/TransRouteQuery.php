<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TransRoute]].
 *
 * @see TransRoute
 */
class TransRouteQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[active]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return TransRoute[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransRoute|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}